<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients'; // Optionnel si le nom de la table est bien "clients"

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
    ];

    // Un client peut avoir plusieurs commandes
    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
}
