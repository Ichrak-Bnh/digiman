<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class commandes extends Model
    {
        use HasFactory;
        protected $fillable = [
            'id_societe',
            'total_amount',
            'status',
            'nom_client',
            'type',
            'email',
            'motif',
            'adresse',
            'telephone',
            'gouvernerat',
        ];

        public function produits()
    {
        return $this->hasManyThrough(
            produits::class,
            commande_produits::class,
            'commande_id',
            'id',
            'id',
            'produit_id'
        )->select('produits.*', 'commande_produits.quantite', 'commande_produits.prix_unitaire');
    }

    }
