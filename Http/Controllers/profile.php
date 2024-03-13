<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class profile extends Controller
{
    public function show_page()
    {
        $user = auth()->user(['avatar', 'name', 'email','taxe','valeur_taxe']);
        return view('admin.parametres.profile')->with('user', $user);
    }

    public function show_page_securite()
    {
        return view('admin.parametres.securite');
    }



    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nom_responsable' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'taxe' => 'string|max:255',
            'valeur_taxe' => 'integer|between:0,100',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->nom_responsable = $request->input('nom_responsable');
        $user->telephone = $request->input('telephone');
        if($request->input('taxe') =="oui"){
            $user->taxe = "oui";
            if(empty( $request->input('valeur_taxe'))){
                $user->valeur_taxe = $user->valeur_taxe;
            }else{
                $user->valeur_taxe = $request->input('valeur_taxe');
            }

        }else{
            $user->taxe = "non";
        }

        if ($request->hasFile('avatar')) {
            $newname = uniqid();
            $avatar = $request->file('avatar');
            $newname .= "." . $avatar->getClientOriginalExtension();
            $destinationPath = 'uploads';
            $avatar->move($destinationPath, $newname);
            $oldFilePath = public_path('uploads/' . $user->avatar);
            if (is_file($oldFilePath) && file_exists($oldFilePath)){
                unlink($oldFilePath);
            }
            $user->avatar = $newname;
        }

        if ($user->save()) {
            return redirect()->back()->with("success", "Mise à jour effectuée");
        } else {
            return redirect()->back()->with("erreur", "Échec de la mise à jour");
        }
    }



    public function update_security(Request $request)
    {
        $user = Auth::user();
        try {
            $this->validate($request, [
                'currentPassword' => [
                    'required',
                    function ($attribute, $value, $fail) use ($user) {
                        if (!Hash::check($value, $user->password)) {
                            return $fail(__('The current password is incorrect.'));
                        }
                    },
                ],
                'newPassword' => 'required|string|min:8|different:currentPassword',
                'confirmPassword' => 'required|string|same:newPassword',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        // Mettre à jour le mot de passe de l'utilisateur
        $user->password = Hash::make($request->input('newPassword'));
        if ($user->save()) {
            Auth::logout();
            return redirect('/login');
        } else {
            return redirect()->back()->with("erreur", "Échec de la mise à jour");
        }
        $user->save();
    }
}
