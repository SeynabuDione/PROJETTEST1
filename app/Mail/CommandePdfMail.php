<?php

namespace App\Mail;

use App\Models\Client;
use App\Models\Commande;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CommandePdfMail extends Mailable
{
    use Queueable, SerializesModels;

    public $client;
    public $commande;
    public $pdfPath;

    /**
     * Create a new message instance.
     */
    public function __construct(Client $client, Commande $commande, $pdfPath)
    {
        $this->client = $client;
        $this->commande = $commande;
        $this->pdfPath = $pdfPath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Votre Commande - PDF', // Sujet de l'email
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.commande_pdf', // La vue de l'email
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        // Attacher le fichier PDF généré à l'email
        return [
            \Illuminate\Mail\Mailables\Attachment::fromStoragePath($this->pdfPath)
                ->as('commande_' . $this->commande->id . '.pdf')
                ->mime('application/pdf'),
        ];
    }
}
