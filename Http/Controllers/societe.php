<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailCreationSociete;


class societe extends Controller
{
    public function show_page()
    {
        return view('admin.societes.ajouter_societe');
    }




    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'nom_responsable' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        function genererMotDePasseAleatoire($longueur = 8) {
            return Str::random($longueur);
        }
        $motDePasseAleatoire = genererMotDePasseAleatoire();
        $societe = new User();
        $newname = uniqid();
        $avatar = $request->file('avatar');
        $newname .= "." . $avatar->getClientOriginalExtension();
        $destinationPath = 'uploads';
        $avatar->move($destinationPath, $newname);
        $societe->avatar = $newname;
        $societe->name = $request->name;
        $societe->assignRole('client');
        $societe->email = $request->email;
        $societe->nom_responsable = $request->nom_responsable;
        $societe->telephone = $request->telephone;
        $societe->password = Hash::make($motDePasseAleatoire);
        if ($societe->save()) {


            $data = [
                'email' => $request->email,
                'password' => $motDePasseAleatoire,
            ];
            Mail::to($request->email)->send(new MailCreationSociete($data));
            return redirect()->back()->with("success", "La société a été ajouté !");
        } else {
            return redirect()->back()->with("erreur", "Echec de l'ajout de la société!");
        }
    }








    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'id' => 'required|integer|max:255',
            'email' => 'required|email|max:255',
            'nom_responsable' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $societe = User::find($request->id);
        if ($societe) {
            if ($request->file('avatar')) {
                $file_Path = public_path() . '/uploads/' . $societe->avatar;
                if (is_file($file_Path) && file_exists($file_Path)) {
                    unlink($file_Path);
                }
                $newname = uniqid();
                $avatar = $request->file('avatar');
                $newname .= "." . $avatar->getClientOriginalExtension();
                $destinationPath = 'uploads';
                $avatar->move($destinationPath, $newname);
                $societe->avatar = $newname;
            }
            $societe->name = $request->name;
            $societe->email = $request->email;
            $societe->nom_responsable = $request->nom_responsable;
            $societe->telephone = $request->telephone;
            if ($societe->update()) {
                return redirect()->back()->with("success", "La société a été modifier !");
            } else {
                return redirect()->back()->with("erreur", "Echec de modification de la société!");
            }
        } else {
            return redirect()->back()->with("erreur", "Cette société n'existe pas ");
        }
    }








    public function show_liste()
    {
        $societes = User::where("role",'!=','admin')->get();
        return view('admin.societes.liste_societe')->with('societes', $societes);
    }




    public function show_edite_page($id)
    {
        $societe = User::find($id);
        if ($societe) {
            return view('admin.societes.editer_societe')->with('societe', $societe);
        } else {
            return redirect()->back()->with("erreur", "La société n'a pas été trouver !");
        }
    }


    public function delete($id){
        $societe = User::find($id);
        if ($societe) {
            $societe->update(["email"=>"delete-".$societe->email]);
            $societe->delete();
            return redirect()->back()->with('message',"La société a bien été supprimé");
            }else{
                return redirect()->back()->with('erreur',"Erreur lors de la supression");
            }

    }



}
