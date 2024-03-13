<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class historique_produits extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_produit',
        'operation',
        'quantite',
        'id_societe	',
    ];



    // Relation avec le modèle Produit
    public function produit()
    {
        return $this->belongsTo(produits::class, 'id_produit')->withTrashed();
    }

}
