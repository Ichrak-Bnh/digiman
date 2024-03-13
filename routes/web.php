<?php

use App\Http\Controllers\categorie;
use App\Http\Controllers\commande;
use App\Http\Controllers\homeController ;
use App\Http\Controllers\notifications;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\societe ;
use App\Http\Controllers\profile ;
use App\Http\Controllers\produit;
use App\Http\Controllers\stock;
use App\Models\commandes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});






Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});



Route::middleware('auth')->group(function () {






    //gestion profil admin
    Route::get('/admin/my_profile/security', [profile::class, 'show_page_securite']);
    Route::post('/admin/my_profile/update_security', [profile::class, 'update_security']);
    Route::get('/admin/my_profile', [profile::class, 'show_page']);
    Route::post('/admin/update/profile', [profile::class, 'update']);








    Route::group(['middleware' => 'admin'], function () {
        // Routes accessibles uniquement par les administrateurs






        Route::get('/index_admin', [homeController::class, 'home']);
        Route::get('/dashboard', [homeController::class, 'home']);
        //gestion des societes
        Route::post('/admin/ajouter_societe', [societe::class, 'create']);
        Route::get('/admin/ajouter_societe', [societe::class, 'show_page']);
        Route::get('/admin/liste_societe', [societe::class, 'show_liste']);
        Route::get('/admin/editer/{id}', [societe::class, 'show_edite_page']);
        Route::get('/admin/delete/{id}', [societe::class, 'delete']);
        Route::post('/admin/update_societe', [societe::class, 'update']);






    });



    Route::group(['middleware' => 'client'], function () {
        // Routes accessibles uniquement par les clients


        //home
        Route::get('/index', [homeController::class, 'home_client']);
        Route::post('/client/statistics', [homeController::class, 'statistics']);
        Route::post('/client/Earning', [homeController::class, 'Earning']);
        Route::post('/client/Revenue', [homeController::class, 'Revenue']);


        //gestion des produits
        Route::get('/client/ajouter_produit', [produit::class, 'show_page']);
        Route::post('/client/ajouter_produit', [produit::class, 'create']);
        Route::get('/client/liste_produit', [produit::class, 'liste_produit']);
        Route::get('/client/editer/produit/{id}', [produit::class, 'show_update_page']);
        Route::post('/client/update_produit', [produit::class, 'update']);
        Route::get('/client/rechercher-produit', [produit::class, 'recherche']);
        Route::get('/client/delete-produit', [produit::class, 'delete_produit']);
        Route::get('/client/suivie_produit/{id}', [produit::class, 'suivie_produit']);
        Route::get('/client/delete_produit_image', [produit::class, 'delete_produit_image']);




        //gestion du stock
        Route::get('/client/ajout_rapide', [stock::class, 'show_page']);
        Route::get('/client/ajout_rapide/{code_bar}', [stock::class, 'recharge_rapide_via_code_bar']);
        Route::post('/client/ajout_rapide_add', [stock::class, 'ajout']);
        Route::get('/client/recherche_produit_code_bar', [stock::class, 'recherche']);



        //gestion des commandes
        Route::get('/client/ajout_commande', [commande::class, 'etape1']);
        Route::post('/client/ajout_commande_etape_1', [commande::class, 'etape1_ajout']);
        Route::get('/client/ajout_commande/etape_2', [commande::class, 'etape2']);
        Route::get('/client/annuler/commande/actuel', [commande::class, 'cancel_commande']);
        Route::get('/client/add_produit_to_panier', [commande::class, 'ajouter_produit_panier']);
        Route::get('/client/update_quantite_produit_to_panier', [commande::class, 'update_quantite_produit_to_panier']);
        Route::get('/client/update_quantite_produit_to_commande', [commande::class, 'update_quantite_produit_to_commande']);
        Route::get('/client/delete_produit_to_panier', [commande::class, 'delete_produit_to_panier']);
        Route::get('/client/delete_produit_to_commande', [commande::class, 'delete_produit_to_commande']);
        Route::get('/client/liste_commandes', [commande::class, 'liste']);
        Route::get('/client/valdier_commande_actuelle', [commande::class, 'valdier_commande_actuelle']);
        Route::get('/client/details_commande/{id}', [commande::class, 'details_commande']);
        Route::post('/client/update_statut_commande', [commande::class, 'update_statut_commande']);
        Route::get('/client/delete_commande', [commande::class, 'delete_commande']);
        Route::get('/client/editer_commande/{id}', [commande::class, 'editer_commande']);
        Route::post('/client/filtre_commande', [commande::class, 'filtre_commande']);
        Route::post('/client/edit_commande_user', [commande::class, 'edit_commande_user']);



        //notification
        Route::get('/client/get_notifications_non_lu', [notifications::class, 'liste_notification_non_lu']);
        Route::get('/client/tout_marquer_lu', [notifications::class, 'tout_marquer_lu']);


        // pdf et generation des fichier
        Route::get('/client/generate-pdf-manifest', [PDFController::class, 'generate_manifest']);
        Route::get('/client/generate-pdf-borderau', [PDFController::class, 'generate_bordereau']);
        Route::get('/client/generate-pdf-excel', [PDFController::class, 'generate_excel']);





        //gestiondes categories
        Route::get('/client/gestion_categories', [categorie::class, 'index']);
        Route::post('/client/ajouter-categorie', [categorie::class, 'ajouter']);
        Route::get('/client/delete_categorie', [categorie::class, 'supprimer']);
        Route::post('/client/update-categorie', [categorie::class, 'update']);


    });



});

require __DIR__ . '/auth.php';
