<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class commande_produits extends Model
{

    use SoftDeletes;


    use HasFactory;
    protected $fillable = [
        'commande_id',
        'produit_id',
        'quantite',
        'prix_unitaire',
        'prix_achat',
    ];


     // Relation avec le modèle Produit
     public function produit()
    {
        return $this->belongsTo(produits::class, 'produit_id')->withTrashed();
    }

}
