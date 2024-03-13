<?php

namespace App\Http\Controllers;

use App\Models\commande_produits;
use App\Models\commandes;
use App\Models\historique_produits;
use App\Models\notifications;
use App\Models\produits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class commande extends Controller
{
    public function etape1()
    {
        if (session()->has('nom_client')) {
            return redirect('/client/ajout_commande/etape_2');
        }
        return view("admin.commandes.ajouter");
    }


    private function getDefautData()
    {
        $commandes = DB::table('commandes')
            ->where('id_societe', Auth::user()->id)
            ->select('id', 'total_amount', 'status', 'nom_client', 'created_at', 'telephone')
            ->orderBy("id", "Desc")
            ->paginate(30);
        $montant_total_commande = Commandes::where('id_societe', Auth::user()->id)
            ->whereNotIn('commandes.status', ['Planification retour', 'Retourné'])
            ->sum('total_amount');
        $montant_total_commande_retourner = Commandes::where('id_societe', Auth::user()->id)
            ->whereIn('status', ['Planification retour', 'Retourné'])
            ->sum('total_amount');
        return [
            'commandes' => $commandes,
            'montant_total_commande_retourner' => $montant_total_commande_retourner,
            'montant_total_commande' => $montant_total_commande,
        ];
    }



    public function liste()
    {
        $DefautData = $this->getDefautData();
        return view("admin.commandes.liste", $DefautData);
    }






    public function filtre_commande(Request $request)
    {
        $DefautData = $this->getDefautData();
        $etat = $request->etat;
        $key = $request->key;
        $date = $request->date;
        $query = commandes::where('id_societe', Auth::user()->id);
        $montant_total_commande = Commandes::where('id_societe', Auth::user()->id);
        if (!empty($etat)) {
            $query->where('status', $etat);
            $montant_total_commande->where('status', $etat);
        }
        if (!empty($date)) {
            $query->whereDate('created_at', $date);
            $montant_total_commande->whereDate('created_at', $date);
        }
        if (!empty($key)) {
            $query->where(function ($q) use ($key) {
                $q->where('id', 'like', "%$key%")
                    ->orWhere('total_amount', 'like', "%$key%")
                    ->orWhere('nom_client', 'like', "%$key%")
                    ->orWhere('telephone', 'like', "%$key%");
            });
            $montant_total_commande->where(function ($q) use ($key) {
                $q->where('id', 'like', "%$key%")
                    ->orWhere('total_amount', 'like', "%$key%")
                    ->orWhere('nom_client', 'like', "%$key%")
                    ->orWhere('telephone', 'like', "%$key%");
            });
        }
        $commandes = $query->paginate(30);
        $DefautData['commandes'] = $commandes;
        $DefautData['montant_total_commande'] = $montant_total_commande->sum('total_amount');

        return view("admin.commandes.liste", $DefautData);
    }





    public function delete_commande(Request $request)
    {
        $commande = commandes::find($request->id);
        if ($commande) {
            $commande->delete();
            return response()->json(['message' => 'Commande supprimer !']);
        } else {
            return response()->json(['erreur' => 'Commande non trouver !']);
        }
    }









    public function editer_commande(Request $request)
    {
        $details = commandes::find($request->id);

        if (!$details) {
            return redirect()->back()->with('erreur', "Commande non trouvée");
        }

        if (!is_null($details->motif)) {
            return redirect()->back()->with('erreur', "Impossible de modifier cette commande");
        }

        $produits = $details->produits()->withTrashed()->get();

        if (!$produits->isEmpty()) {
            return view("admin.commandes.editer_commande")
                ->with('commande', $details)
                ->with('produits', $produits);
        } else {
            // Si la commande est vide, elle est automatiquement supprimée
            return redirect()->back()->with('erreur', "Cette commande est vide");
        }
    }











    public function update_statut_commande(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_commande' => 'required|string|max:255|exists:commandes,id',
            'statut' => 'required',
            'motif' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json(['erreur' => $errors], 422);
        }

        $commande = Commandes::where('id', $request->id_commande)->where('id_societe', Auth::user()->id)->first();

        if ($commande) {
            $commande->status = $request->statut;

            if ($request->statut == "Retourné") {
                $commande->motif = $request->input("motif", ".");
                $produit_retirer = commande_produits::where('commande_id', $request->id_commande)->get();
                foreach ($produit_retirer as $item) {
                    $produit = produits::where('id', $item->produit_id)->first();
                    if ($produit) {
                        $produit->quantite =  $produit->quantite + $item->quantite;
                        $produit->update();
                    }
                }
            } else {
                $commande->motif = null;
            }

            if ($commande->update()) {
                return response()->json(['message' => 'Mise à jour effectuée !']);
            } else {
                return response()->json(['erreur' => 'Erreur de mise à jour'], 401);
            }
        } else {
            return response()->json(['erreur' => 'Commande non trouvée !'], 404);
        }
    }











    public function etape2()
    {
        $products = session()->get('products');
        $totalQuantiteEnPanier = 0;
        $productDetails = [];
        if (isset($products)) {
            foreach ($products as $product) {
                $details = produits::find($product['id']);
                $details->quantite = $product['quantity'];
                $totalQuantiteEnPanier += $product['quantity'];
                $productDetails[] = $details;
            }
        }
        return view("admin.commandes.ajouter_2", compact('productDetails', 'totalQuantiteEnPanier'));
    }








    public function details_commande($id)
    {
        $details = commandes::where("id", $id)->where('id_societe', Auth::user()->id)->first();
        $produits = [];
        if ($details) {
            $total_commande_client =  commandes::where("nom_client", $details->nom_client)
                ->where('id_societe', Auth::user()->id)->count();
            $produits = $details->produits()->withTrashed()->get();
            return view("admin.commandes.details_commande")
                ->with('commande', $details)
                ->with('total_commande_client', $total_commande_client)
                ->with('produits', $produits);
        }
    }









    public function update_quantite_produit_to_commande(Request $request)
    {
        $nouvelle_quantite = $request->quantite;
        $id_commande = $request->id_commande;
        $user_id = Auth::user()->id;

        $commande = commandes::where("id", $id_commande)
            ->where('id_societe', $user_id)
            ->first();

        if (!$commande) {
            return response()->json(['erreur' => "Vous n'avez pas la permission de modifier cette commande"]);
        }

        $produit = commande_produits::where("produit_id", $request->id)
            ->where("commande_id", $commande->id)
            ->first();

        if (!$produit) {
            return response()->json(['erreur' => "Produit non trouvé !"]);
        }

        $old_qte = $produit->quantite;
        $stock = produits::where('id', $produit->produit_id)
            ->where('id_societe', $user_id)
            ->value('quantite');

        if ($nouvelle_quantite > $old_qte) {
            $quantite = $nouvelle_quantite - $old_qte;
            if ($stock >= $quantite) {
                produits::where('id', $produit->produit_id)
                    ->where('id_societe', $user_id)
                    ->update(['quantite' => DB::raw('quantite - ' . $quantite)]);

                commande_produits::where("produit_id", $request->id)
                    ->where("commande_id", $commande->id)
                    ->update(['quantite' => $nouvelle_quantite]);
            } else {
                return response()->json(['erreur' => "Stock limité à " . $stock . " unités"]);
            }
        } elseif ($nouvelle_quantite < $old_qte) {
            $quantite = $old_qte - $nouvelle_quantite;
            // Vérifie si la nouvelle quantité est inférieure au stock
            if ($nouvelle_quantite <= $stock) {
                produits::where('id', $produit->produit_id)
                    ->where('id_societe', $user_id)
                    ->update(['quantite' => DB::raw('quantite + ' . $quantite)]);

                commande_produits::where("produit_id", $request->id)
                    ->where("commande_id", $commande->id)
                    ->update(['quantite' => $nouvelle_quantite]);
            } else {
                return response()->json(['erreur' => "Stock limité à " . $stock . " unités"]);
            }
        }

        // Mise à jour du total_amount de la commande
        $total = commande_produits::where('commande_id', $id_commande)
            ->sum(DB::raw('quantite * prix_unitaire'));

        commandes::where('id', $id_commande)
            ->where('id_societe', $user_id)
            ->update(['total_amount' => $total]);

        return response()->json(['message' => "Modifié !"]);
    }











    public function update_quantite_produit_to_panier(Request $request)
    {
        $products = session()->get('products', []);

        $existingProductIndex = array_search($request->id, array_column($products, 'id'));

        if ($existingProductIndex !== false) {
            $newQuantity = $request->quantite;
            $produit = produits::where("id", $request->id)
                ->where('id_societe', Auth::user()->id)
                ->first();

            if ($produit) {
                $availableStock = $produit->quantite;
                if ($newQuantity <= $availableStock) {
                    $products[$existingProductIndex]['quantity'] = $newQuantity;
                    session()->put('products', $products);
                    return response()->json(['message' => 'Mise à jour effectuée']);
                } else {
                    return response()->json(['erreur' => 'Stock insuffisant, il reste uniquement ' . $availableStock]);
                }
            } else {
                return response()->json(['erreur' => 'Produit non trouvé dans le stock !']);
            }
        } else {
            return response()->json(['message' => 'Produit non trouvé dans le panier !']);
        }
    }






    public function etape1_ajout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom_client' => 'required|string|max:255',
            'type' => 'nullable|string'
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data_etape_1 = [
            "nom_client" => $request->nom_client,
            "email" => $request->email,
            "type" => $request->type,
            "telephone" => $request->telephone,
            "gouvernerat" => $request->gouvernorat,
            "adresse" => $request->adresse,
        ];
        session($data_etape_1);
        return redirect('/client/ajout_commande/etape_2');
    }







    public function cancel_commande()
    {
        $nom_client = session('nom_client');
        $email = session('email');
        $telephone = session('telephone');
        $gouvernerat = session('gouvernerat');
        $adresse = session('adresse');
        session()->forget(['nom_client', 'email', 'telephone', 'gouvernerat', 'adresse','products']);
        return redirect('/client/ajout_commande');
    }





    public function ajouter_produit_panier(Request $request)
    {
        $productId = $request->id;
        $products = session()->get('products', []);
        $existingProductIndex = array_search($productId, array_column($products, 'id'));

        if ($existingProductIndex === false) {
            $productDetails = produits::find($productId);
            $newProduct = [
                'id' => $productId,
                'quantity' => 1,
            ];
            $products[] = $newProduct;
        } else {
            $products[$existingProductIndex]['quantity'] += 1;
        }
        session(['products' => $products]);
        return response()->json(['message' => $productDetails->nom . " Ajouter au panier."]);
    }






    public function delete_produit_to_panier(Request $request)
    {
        $products = session()->get('products', []);
        $indexToRemove = null;

        foreach ($products as $key => $value) {
            if ($value['id'] == $request->id) {
                $indexToRemove = $key;
                break;
            }
        }

        if ($indexToRemove !== null) {
            unset($products[$indexToRemove]);
            session(['products' => $products]);
            return response()->json(['message' => 'supprimer']);
        } else {
            return response()->json(['erreur' => 'produit non trouvé dans le panier']);
        }
    }





    public function  delete_produit_to_commande(Request $request)
    {
        $id_produit = $request->id;
        $id_commande = $request->id_commande;
        $produit = commande_produits::where('produit_id', $id_produit)->where("commande_id", $id_commande)->first();
        if ($produit) {
            produits::where('id', $id_produit)
                ->where('id_societe', Auth::user()->id)
                ->update(['quantite' => DB::raw('quantite + ' . $produit->quantite)]);
            $produit = commande_produits::where('produit_id', $id_produit)
                ->where("commande_id", $id_commande)
                ->delete();


            //mise a Jour du total_amount de la commande
            $total = commande_produits::where('commande_id', $id_commande)
                ->sum(DB::raw('quantite * prix_unitaire'));

            commandes::where('id', $id_commande)
                ->where('id_societe', Auth::user()->id)
                ->update(['total_amount' => $total]);

            return response()->json(['message' => 'produit supprimé ']);
        } else {
            return response()->json(['erreur' => 'produit non trouvé ']);
        }
    }








    public function edit_commande_user(Request $request)
    {
        $id_commande = $request->id_commande;
        $commande = commandes::where('id', $id_commande)->where('id_societe', Auth::user()->id)->first();
        if ($commande) {
            $commande->email = $request->email;
            $commande->telephone = $request->telephone;
            $commande->adresse = $request->adresse;
            if ($commande->update()) {
                return response()->json(['message' => 'Modification effectuer !']);
            } else {
                return response()->json(['erreur' => 'Echec de modification !']);
            }
        } else {
            return response()->json(['erreur' => 'Commande non trouvé ']);
        }
    }












    public function valdier_commande_actuelle()
    {
        // Récupérer les produits du panier depuis la session
        $products = session()->get('products');

        // Vérifier si le panier n'est pas vide
        if (!empty($products)) {
            // Créer une nouvelle commande dans la base de données
            $commande = new commandes([
                'id_societe' => Auth::user()->id,
                'total_amount' => 0,
                'status' => 'Crée',
                'nom_client' => session('nom_client'),
                'email' => session('email'),
                'telephone' => session('telephone'),
                'gouvernerat' => session('gouvernerat'),
                'adresse' => session('adresse'),
                'type' => session('type')
            ]);
            $commande->save();
            $nouvelIdCommande = $commande->id;


            // Récupérer les produits de la session
            $products = session()->get('products', []);

            // Calculer le total de la commande
            $totalAmount = 0;

            // Parcourir les produits
            foreach ($products as $product) {
                // Récupérer le produit de la base de données
                $produit = produits::find($product['id']);

                // Vérifier si le produit existe
                if ($produit) {
                    $commande_line = new commande_produits();
                    $commande_line->commande_id = $nouvelIdCommande;
                    $commande_line->produit_id = $produit->id;
                    $commande_line->quantite = $product['quantity'];
                    $commande_line->prix_unitaire = $produit->prix_vente;
                    $commande_line->prix_achat = $produit->prix_achat;
                    $commande_line->save();
                    //soustraire le produit
                    produits::where("id", $product['id'])->update(['quantite' => $produit->quantite - $product['quantity']]);


                    //enregistrement de l(jistorique dans la table historique_produits
                    $historiqueProduit = new historique_produits();
                    $historiqueProduit->id_produit = $produit->id;
                    $historiqueProduit->quantite = $product['quantity'];
                    $historiqueProduit->id_societe = Auth::user()->id;
                    $historiqueProduit->operation = "vente";
                    $historiqueProduit->save();



                    $nouvelle_qte = produits::find($product['id']);
                    //si le stock de securite est toucher faire la notification
                    if ($nouvelle_qte->stock_securite >= $nouvelle_qte->quantite) {
                        $notification = new notifications();
                        $notification->id_societe = Auth::user()->id;
                        $notification->statut = "unread";
                        $notification->titre = "Alerte stock";
                        $notification->message = "Stock de securite atteint pour le produit " . $nouvelle_qte->nom;
                        $notification->save();
                    }

                    // Mettre à jour le total de la commande
                    $totalAmount += $product['quantity'] * $produit->prix_vente;
                }
            }

            $commande->update(['total_amount' => $totalAmount]);
            // Vider le panier
            session()->forget(['nom_client', 'email', 'telephone', 'gouvernerat', 'adresse', 'products']);
            return redirect("/client/liste_commandes")
                ->with("success", 'Commande validée avec succès');
        } else {
            return redirect()
                ->back()
                ->with("erreur", 'Le panier est vide');
        }
    }
}
