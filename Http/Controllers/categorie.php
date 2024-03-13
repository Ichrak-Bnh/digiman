<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\produits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class categorie extends Controller
{
    
    public function index(){
        $categories = categories::Orderby('id',"Desc")->where('id_societe', Auth::user()->id)->get();
        return view('admin.categories.ajouter')->with('categories',$categories);
    }

    public function ajouter(Request $request){
        $validator = Validator::make($request->all(), [
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icone' => 'required|image|mimes:jpg,png,jpeg|max:2048'
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $categorie = new categories();
        if ($request->file('icone')) {
            $image = $request->file('icone');
            $newname = uniqid() . "icone." . $image->getClientOriginalExtension();
            $destinationPath = 'uploads';
            $image->move($destinationPath, $newname);
            $categorie->icone = $newname;
        }
        $categorie->titre=$request->titre;
        $categorie->description = $request->description;
        $categorie->id_societe  = Auth::user()->id;
        $categorie->save();
        return redirect()->back()->with("success","Catégorie ". $request->titre . "  Ajouter !");
        //return response()->json(["message"=>"Catégorie ". $request->titre . "  Ajouter !"]);
    }



    public function supprimer( Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:categories,id',
        ]);
        if ($validator->fails()) {
            return response()->json(["erreur"=>"Echec de la suppression de cette Catégorie !"]);
        }
        $categorie = categories::where('id',$request->id)->where('id_societe', Auth::user()->id)->first();
        if(!$categorie){
            return response()->json(["erreur"=>"Echec cette catégorie n'existe pas !"]);
        }
        $categorie->delete();
        produits::where("categorie",$categorie->id)->delete();
        return response()->json(["message"=>"Catégorie supprimer !"]);
    }



    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'edition_titre' => 'required|string|max:255',
            'edition_description' => 'nullable|string',
            'id' => 'required|integer|exists:categories,id',
            'icone' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $categorie = categories::where('id',$request->id)->where('id_societe', Auth::user()->id)->first();
        if(!$categorie){
            return redirect()->back()->with("ereur","Echec de modification de cette Catégorie !");
        }
        if ($request->file('icone')) {
            $image = $request->file('icone');
            $file_Path = public_path() . '/uploads/' . $categorie->icone;
            if (is_file($file_Path) && file_exists($file_Path)) {
                unlink($file_Path);
            }
            $newname = uniqid() . "icone." . $image->getClientOriginalExtension();
            $destinationPath = 'uploads';
            $image->move($destinationPath, $newname);
            $categorie->icone = $newname;
        }
        $categorie->titre  = $request->edition_titre;
        $categorie->description  = $request->edition_description;
        $categorie->update();
        return redirect()->back()->with("success","Catégorie ". $request->titre . "  Modifier  !");
    }


}
