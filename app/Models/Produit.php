<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $table = 'produits'; // Optionnel si le nom de la table est bien "produits"

    protected $fillable = [
        'nom',
        'description',
        'prix',
        'image',
        'stock',
    ];

    // Un produit peut être dans plusieurs commandes
    public function commandes()
    {
//return $this->hasMany(Commande::class);
        return $this->belongsToMany(Commande::class, 'commande_produit')->withPivot('quantite')->withTimestamps();
    }

 
}
