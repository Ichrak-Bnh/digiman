<?php

namespace App\Models;

use App\Http\Controllers\produit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class galleries extends Model
{
    use HasFactory;
    protected $fillable = [
        'url',
        'id_produit',
    ];


    public function produit_info()
    {
        return $this->belongsTo(produits::class, 'id_produit');
    }

}
