<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre',
        'icone',
        'description',
    ];


    public function produits()
    {
        return $this->hasMany(produits::class, 'categorie');
    }

}
