<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    
    protected $fillable = ['total', 'status', 'nombre_de_pieces', 'client_id', 'produit_id'];


    // Relation avec le client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
  
    

   
    // Relation Many-to-Many avec le produit via la table pivot commande_produit
    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'commande_produit')->withPivot('quantite')->withTimestamps();
    
       // return $this->belongsToMany(Produit::class)->withPivot('quantite');
    }
    
}
