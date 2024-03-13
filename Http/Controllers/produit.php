<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\commande_produits;
use App\Models\galleries;
use App\Models\historique_produits;
use App\Models\produits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class produit extends Controller
{
    public function show_page()
    {
        $categories = categories::select("titre", "description")->where('id_societe', Auth::user()->id)->get();
        return view('admin.produits.ajouter')
            ->with('categories', $categories);
    }



    public function liste_produit()
    {
        $produits = produits::where('id_societe', Auth::user()->id)
            ->Orderby('id', 'Desc')
            ->with('categorie_info')
            ->paginate(20);
        $moyenne_ventes = commande_produits::join('commandes', 'commandes.id', '=', 'commande_produits.commande_id')
            ->where('commandes.id_societe', Auth::user()->id)
            ->avg('commande_produits.quantite');
        return view('admin.produits.liste')
            ->with('moyenne_ventes', $moyenne_ventes)
            ->with('produits', $produits);
    }



    public function show_update_page($id)
    {
        $produit = produits::where('id', $id)->where('id_societe', Auth::user()->id)->first();
        $categories = categories::select("titre", "description")->where('id_societe', Auth::user()->id)->get();
        if ($produit) {
            return view('admin.produits.update')->with('produit', $produit)
                ->with('categories', $categories);
        }
    }




    public function suivie_produit(Request $request)
    {
        $produit = produits::find($request->id);
        if ($produit) {
            $recharges = historique_produits::where("id_produit", $request->id)
                ->where("operation", "recharge")
                ->Orderby("id", "Desc")
                ->where('id_societe', Auth::user()->id)->get();
            $ventes = historique_produits::where("id_produit", $request->id)
                ->where("operation", "vente")
                ->Orderby("id", "Desc")
                ->where('id_societe', Auth::user()->id)->get();
            return view("admin.produits.suivie")
                ->with("recharges", $recharges)
                ->with("ventes", $ventes)
                ->with("produit", $produit);
        } else {
            return redirect()->back()->with("erreur", "Produit non trouver !");
        }
    }




    public function recherche(Request $request)
    {
        $min_prix = $request->min_prix;
        $max_prix = $request->max_prix;
        $statut = $request->statut;
        $term = $request->input('term');

        $query = produits::where('id_societe', Auth::user()->id);

        if (!empty($term)) {
            $query->where(function ($q) use ($term) {
                $q->where('nom', 'like', "%$term%")
                    ->orWhere('code_bar', 'like', "%$term%");
            });
        }
        if (!empty($min_prix)) {
            $query->where('prix_vente', '>=', $min_prix);
        }
        if (!empty($max_prix)) {
            $query->where('prix_vente', '<=', $max_prix);
        }
        if (!empty($statut)) {
            $query->where('statut', $statut);
        }
        $produits = $query->get();

        return response()->json(['produits' => $produits]);
    }






    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'prix_achat' => 'required|integer',
            'categorie' => 'required|string|exists:categories,titre',
            'prix_vente' => 'required|integer|gte:prix_achat,Prix de vente doit être supérieur ou égal au prix d\'achat',
            'stock_securite' => 'required|integer',
            'code_bar' => 'required|string|unique:produits,code_bar',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'gallerie.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallerie' => 'max:4',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $produit = new produits();


        //import image
        if ($request->file('file')) {
            $newname = uniqid();
            $photo = $request->file('file');
            $newname .= "produit-." . $photo->getClientOriginalExtension();
            $destinationPath = 'uploads';
            $photo->move($destinationPath, $newname);
            $produit->photo = $newname;
        }
        $categorie = categories::where('titre', $request->categorie)->select("id")->first();
        $produit->nom = $request->nom;
        $produit->categorie = $categorie->id;
        $produit->statut = 'indisponible';
        $produit->description = $request->description;
        $produit->prix_achat = $request->prix_achat;
        $produit->quantite = 0;
        $produit->id_societe = Auth::user()->id;
        $produit->prix_vente = $request->prix_vente;
        $produit->stock_securite = $request->stock_securite;
        $produit->code_bar = $request->code_bar;
        if ($produit->save()) {
            // import 4 images
            if ($request->hasFile('gallerie')) {
                $images = $request->file('gallerie');
                foreach ($images as $image) {
                    $newname = uniqid();
                    $newname .= "produit-." . $image->getClientOriginalExtension();
                    $destinationPath = 'uploads';
                    $image->move($destinationPath, $newname);
                    galleries::create(["id_produit" => $produit->id, "url" => $newname]);
                }
            }

            return redirect()->back()->with("success", "Le produit a été ajouté !");
        } else {
            return redirect()->back()->with("erreur", "Echec de l'ajout du produit !");
        }
    }





    public function delete_produit(Request $request)
    {
        $produit = produits::where('id', $request->id)->where('id_societe', Auth::user()->id)->first();
        if ($produit) {
            $produit->delete();
            return  response()->json(['message' => "supprimer"]);
        } else {
            return  response()->json(['erreur' => "produit non trouver !"]);
        }
    }








    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'categorie' => 'required|string|exists:categories,titre',
            'prix_achat' => 'required|integer',
            'prix_vente' => 'required|integer|gte:prix_achat,Prix de vente doit être supérieur ou égal au prix d\'achat',
            'stock_securite' => 'required|integer',
            'code_bar' => 'required|integer',
            'id' => 'required|integer|exists:produits,id',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'gallerie.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallerie' => 'max:4',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $produit = produits::find($request->id);
        if ($produit) {
            if ($request->file('photo')) {
                $file_Path = public_path() . '/uploads/' . $produit->photo;
                if (is_file($file_Path) && file_exists($file_Path)) {
                    unlink($file_Path);
                }
                $newname = uniqid();
                $photo = $request->file('photo');
                $newname .= "." . $photo->getClientOriginalExtension();
                $destinationPath = 'uploads';
                $photo->move($destinationPath, $newname);
                $produit->photo = $newname;
            }
            $categorie = categories::where('titre', $request->categorie)->select("id")->first();
            $produit->nom = $request->nom;
            $produit->description = $request->description;
            $produit->prix_achat = $request->prix_achat;
            $produit->categorie =  $categorie->id;
            $produit->prix_vente = $request->prix_vente;
            $produit->stock_securite = $request->stock_securite;
            $produit->code_bar = $request->code_bar;
            if ($produit->update()) {

                if ($request->hasFile('gallerie')) {

                    $images = $request->file('gallerie');
                    foreach ($images as $image) {
                        $newname = uniqid();
                        $newname .= "produit-." . $image->getClientOriginalExtension();
                        $destinationPath = 'uploads';
                        $image->move($destinationPath, $newname);
                        galleries::create(["id_produit" => $produit->id, "url" => $newname]);
                    }
                }


                return redirect()->back()->with("success", "La mise a jour a été effectuer !");
            } else {
                return redirect()->back()->with("erreur", "Echec de la mise a jour du produit !");
            }
        } else {
            return redirect()->back()->with("erreur", "Ce produit n'existe pas !");
        }
    }




    public function delete_produit_image(Request $request)
    {
        $image = galleries::where("id", $request->id_image)->first();
        if (!$image) {
            return response()->json(["erreur" => "Echec"]);
        }
        $produit = $image->produit_info;
        if (!$produit) {
            return response()->json(["erreur" => "Echec !"]);
        }

        if ($produit->id_societe !== Auth::user()->id) {
            return response()->json(["erreur" => "Echec de suppressio !"]);
        }

        $file_Path = public_path() . '/uploads/' . $image->url;
        if (is_file($file_Path) && file_exists($file_Path)) {
            unlink($file_Path);
        }

        $image->delete();

        return response()->json(["message" => "Image supprimer"]);
    }
}
