<?php

namespace App\Http\Controllers;

use App\Models\historique_produits;
use App\Models\produits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class stock extends Controller
{
    public function show_page()
    {
        return view("admin.stock.ajouter");
    }



    public function ajout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code_bar' => 'required|exists:produits,code_bar',
            'quantite' => 'required|integer|min:1',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $produit = Produits::where('code_bar', $request->code_bar)
            ->select("quantite", "id")
            ->where('id_societe', Auth::user()->id)
            ->first();
        if ($produit) {
            $nouvelleQuantite = $produit->quantite + $request->quantite;
            $produit->update(['quantite' => $nouvelleQuantite, 'statut' => "disponible"]);

            //enregistrement de l(jistorique dans la table historique_produits
            $historiqueProduit = new historique_produits();
            $historiqueProduit->id_produit = $produit->id;
            $historiqueProduit->quantite = $request->quantite;
            $historiqueProduit->id_societe = Auth::user()->id;
            $historiqueProduit->operation = "recharge";
            $historiqueProduit->save();
            return response()->json(["message"=> "Quantité mise à jour avec succès !"]);
        } else {
            return response()->json(['erreur' => "Ce produit n'existe pas !"]);
        }
    }


    public function recharge_rapide_via_code_bar(Request $request){
        $code_bar = $request->code_bar;
        $produit = produits::where("code_bar",$code_bar)->first();
        if($produit){
            return view('admin.stock.ajouter')->with('code_bar', $code_bar);
        }else{
            return redirect('/client/ajout_rapide')->with("erreur", "Ce produit n'existe pas !");
        }
    }

    public function recherche(Request $request)
    {
        $key = $request->input('key');
        if ($key != "") {
            $results = produits::where('nom', 'like', "%$key%")
                ->where('id_societe', Auth::user()->id)
                ->where('quantite','>',0)
                ->select('nom', 'code_bar', 'photo','prix_vente','id')
                ->get();
        } else {
            $results = [];
        }

        return response()->json($results);
    }
}
