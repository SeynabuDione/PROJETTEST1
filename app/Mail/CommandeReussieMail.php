<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade as pdf;

class CommandeReussieMail extends Mailable
{
    use Queueable, SerializesModels;

    public $commande;

    /**
     * Crée une nouvelle instance du message.
     */
    public function __construct($commande)
    {
        $this->commande = $commande;
    }

    /**
     * Construire le message.
     */
    public function build()
    {
        // Générer un fichier CSV en mémoire
        $csvData = "Client,Produit,Quantité,Total\n";
        $csvData .= "{$this->commande->client->nom},{$this->commande->produit->nom},{$this->commande->quantite},{$this->commande->total}\n";
    
        // Retourner l'e-mail avec la pièce jointe CSV
        return $this->subject('Commande Réussie')
                    ->markdown('emails.commande_reussie')
                    ->attachData($csvData, 'facture.csv', [
                        'mime' => 'text/csv',
                    ]);
    }
}    
