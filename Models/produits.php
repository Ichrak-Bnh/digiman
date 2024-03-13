<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class produits extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $softDelete = true;
    protected $fillable = [
        'quantite',
        'nom',
        'statut',
    ];




    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'commande_produits')
                    ->withPivot('quantite', 'prix_unitaire');
    }

    public function gallerie_info()
    {
        return $this->hasMany(galleries::class, 'id_produit', 'id');
    }

    public function categorie_info()
    {
        return $this->belongsTo(categories::class, 'categorie');
    }


}



