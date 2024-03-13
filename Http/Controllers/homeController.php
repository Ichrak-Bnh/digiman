<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\commande_produits;
use App\Models\commandes;
use App\Models\produits;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home()
    {
        return view('admin.index');
    }





    private function getDashboardData()
    {

        // Top 10 des produits les plus vendus
        $topProductsByQuantity = commande_produits::select('produit_id', 'prix_unitaire', DB::raw('SUM(quantite) as total_quantite'))
            ->join('commandes', 'commandes.id', '=', 'commande_produits.commande_id')
            ->where('commandes.id_societe', Auth::user()->id)
            ->groupBy('produit_id', 'prix_unitaire')
            ->orderByDesc('total_quantite')
            ->limit(10)
            ->get();

        // Top 10 des produits ayant généré le plus gros chiffre d'affaires
        $topProductsByRevenue = commande_produits::select('produit_id', DB::raw('SUM(prix_unitaire * quantite) as total_revenue'))
            ->join('commandes', 'commandes.id', '=', 'commande_produits.commande_id')
            ->where('commandes.id_societe', Auth::user()->id)
            ->groupBy('produit_id')
            ->orderByDesc('total_revenue')
            ->limit(10)
            ->get();

        $topGouvernorats = commandes::select('gouvernerat', DB::raw('SUM(total_amount) as total_achats'))
            ->where('id_societe', Auth::user()->id)
            ->groupBy('gouvernerat')
            ->orderByDesc('total_achats')
            ->limit(5)
            ->get();
        $topClients = commandes::select('nom_client', 'id_societe', DB::raw('SUM(total_amount) as total_achats'))
            ->where('id_societe', Auth::user()->id)
            ->groupBy('nom_client', 'id_societe')
            ->orderByDesc('total_achats')
            ->limit(5)
            ->get();
        $beneficeTotal = commande_produits::select(DB::raw('COALESCE(SUM((commande_produits.prix_unitaire - commande_produits.prix_achat) * commande_produits.quantite), 0) as benefice_total'))
            ->join('commandes', 'commandes.id', '=', 'commande_produits.commande_id')
            ->whereIn('commandes.status', ['Livré et payé', 'Livré'])
            ->where('commandes.id_societe', Auth::user()->id)
            ->get();
        $benefice  = commande_produits::select(DB::raw('COALESCE(SUM((commande_produits.prix_unitaire - commande_produits.prix_achat) * commande_produits.quantite), 0) as benefice_total'))
            ->join('commandes', 'commandes.id', '=', 'commande_produits.commande_id')
            ->whereIn('commandes.status', ['Livré et payé', 'Livré'])
            ->where('commandes.id_societe', Auth::user()->id)
            ->get();

        $anneeActuelle = date('Y');
        $revenusMensuels = [];
        for ($mois = 1; $mois <= 12; $mois++) {
            $revenus = commandes::where('id_societe', Auth::user()->id)
                ->whereYear('created_at', $anneeActuelle)
                ->whereMonth('created_at', $mois)
                ->whereIn('status', ['Livré et payé', 'Livré'])
                ->sum('total_amount');
            $revenusMensuels[] = $revenus;
        }
        $Maxrevenus = max($revenusMensuels);
        $revenusMensuelsTotal = commandes::where('id_societe', Auth::user()->id)
            ->whereYear('created_at', $anneeActuelle)
            ->whereIn('status', ['Livré et payé', 'Livré'])
            ->sum('total_amount');

        $status_list = ['Crée', 'En cours de livraison', 'Livré', 'Livré et payé', 'Planification retour', 'Retourné'];
        $statutsTotals = commandes::selectRaw('status, COUNT(*) as total')
            ->where('id_societe', Auth::user()->id)
            ->groupBy('status')
            ->pluck('total', 'status')
            ->all();
        $statutsTotals = array_map(function ($statut) use ($statutsTotals) {
            return [
                'status' => $statut,
                'total' => $statutsTotals[$statut] ?? 0,
            ];
        }, $status_list);
        $total_produits = produits::where('id_societe', Auth::user()->id)->count();
        $commandes = commandes::where('id_societe', Auth::user()->id)->select("status")->get();
        $montant_total_commande = commandes::where('id_societe', Auth::user()->id)
        ->whereNotIn('status', ['Planification retour', 'Retourné'])->sum('total_amount');
        $recette = commandes::where('id_societe', Auth::user()->id)->whereIn('status', ['Livré et payé', 'Livré'])->sum('total_amount');
        $nombreTotalClients = commandes::where('id_societe', Auth::user()->id)->count();
        $nombreProduitVendu = commande_produits::join('commandes', 'commandes.id', '=', 'commande_produits.commande_id')
            ->where('commandes.id_societe', Auth::user()->id)
            ->count();

        $commandesLivre = commandes::whereIn('status', ['Livré et payé', 'Livré'])
            ->where('id_societe', Auth::user()->id)
            ->count();
        $tauxLivraison = ($commandes->count() > 0) ? ($commandesLivre / $commandes->count()) * 100 : 0;
        $commandesRetourner = commandes::whereIn('commandes.status', ['Planification retour', 'Retourné'])
            ->where('id_societe', Auth::user()->id)
            ->count();
        $tauxRetour = ($commandes->count() > 0) ? ($commandesRetourner / $commandes->count()) * 100 : 0;
        return [
            'total_produits' => $total_produits,
            'commandes' => $commandes,
            'montant_total_commande' => $montant_total_commande,
            'topClients' => $topClients,
            'topGouvernorats' => $topGouvernorats,
            'nombreTotalClients' => $nombreTotalClients,
            'nombreProduitVendu' => $nombreProduitVendu,
            'beneficeTotal' => $beneficeTotal,
            'statutsTotals' => $statutsTotals,
            'tauxLivraison' => $tauxLivraison,
            'tauxRetour' => $tauxRetour,
            'benefice' => $benefice,
            'max_revenue' => $Maxrevenus,
            'revenus' => $revenusMensuels,
            'recette' => $recette,
            'revenusMensuelsTotal' =>  $revenusMensuelsTotal,
            'topProductsByQuantity' => $topProductsByQuantity,
            "topProductsByRevenue" =>$topProductsByRevenue
        ];
    }




    public function home_client()
    {
        $dashboardData = $this->getDashboardData();
        return view('admin.index_client', $dashboardData);
    }


    public function statistics(Request $request)
    {
        $key = $request->key;
        $dashboardData = $this->getDashboardData();
        $dateDebut = $request->debut;
        $dateFin = $request->fin;
        $dashboardData['nombreProduitVendu'] = commande_produits::join('commandes', 'commandes.id', '=', 'commande_produits.commande_id')
            ->where('commandes.id_societe', Auth::user()->id)
            ->whereBetween('commande_produits.created_at', [$dateDebut, $dateFin])
            ->count();
        $dashboardData['nombreTotalClients'] = commandes::whereBetween('created_at', [$dateDebut, $dateFin])
            ->where('id_societe', Auth::user()->id)
            ->count();
        $dashboardData['beneficeTotal'] = commande_produits::join('commandes', 'commandes.id', '=', 'commande_produits.commande_id')
            ->whereIn('commandes.status', ['Livré et payé', 'Livré'])
            ->whereBetween('commande_produits.created_at', [$dateDebut, $dateFin])
            ->select(DB::raw('COALESCE(SUM((commande_produits.prix_unitaire - commande_produits.prix_achat) * commande_produits.quantite), 0) as benefice_total'))
            ->get();
        return view('admin.index_client', $dashboardData)->with('statistics', ['debut' => $dateDebut, 'fin' => $dateFin]);
    }




    public function Earning(Request $request)
    {
        $mois = $request->mois;
        $annee = $request->annee;
        $dashboardData = $this->getDashboardData();

        $dashboardData['recette'] = commandes::where('id_societe', Auth::user()->id)
            ->whereIn('status', ['Livré et payé', 'Livré'])
            ->whereYear('created_at', $annee)
            ->whereMonth('created_at', $mois)
            ->sum('total_amount');
        $dashboardData['benefice'] = commande_produits::select(DB::raw('COALESCE(SUM((commande_produits.prix_unitaire - commande_produits.prix_achat) * commande_produits.quantite), 0) as benefice_total'))
            ->join('commandes', 'commandes.id', '=', 'commande_produits.commande_id')
            ->whereIn('commandes.status', ['Livré et payé', 'Livré'])
            ->whereYear('commandes.created_at', $annee)
            ->whereMonth('commandes.created_at', $mois)
            ->where('commandes.id_societe', Auth::user()->id)
            ->get();
        return view('admin.index_client', $dashboardData)->with('Earning', ['mois' => $mois, 'annee' => $annee]);
    }



    public function Revenue(Request $request)
    {
        $anneeActuelle = $request->date;
        $dashboardData = $this->getDashboardData();

        $revenusMensuels = [];
        for ($mois = 1; $mois <= 12; $mois++) {
            $revenus = commandes::where('id_societe', Auth::user()->id)
                ->whereYear('created_at', $anneeActuelle)
                ->whereMonth('created_at', $mois)
                ->whereIn('status', ['Livré et payé', 'Livré'])
                ->sum('total_amount');
            $revenusMensuels[] = $revenus;
        }
        $dashboardData['revenus'] = $revenusMensuels;
        $dashboardData['max_revenue'] = max($revenusMensuels);
        $dashboardData['revenusMensuelsTotal'] = commandes::where('id_societe', Auth::user()->id)
            ->whereIn('status', ['Livré et payé', 'Livré'])
            ->whereYear('created_at', $anneeActuelle)
            ->sum('total_amount');

        return view('admin.index_client', $dashboardData)->with('date_revenue', $anneeActuelle);
    }
}
