<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Commande;
use App\Models\Produit;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\CommandeReussieMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\CommandePdfMail;




class CommandeController extends Controller
{
    public function generatePdf($id)
{
    // Récupérer la commande avec ses relations
    $commande = Commande::with(['client', 'produits'])->findOrFail($id);

    // Générer le PDF à partir de la vue
    $pdf = PDF::loadView('pdf.commande', compact('commande'));

    // Retourner le PDF comme réponse
    return $pdf->download('commande_' . $commande->id . '.pdf');
}
public function sendEmail($commandeId)
{
    // Récupérer la commande avec ses informations
    $commande = Commande::with(['client', 'produits'])->findOrFail($commandeId);

    // Générer le PDF
    $pdf = PDF::loadView('pdf.commande', compact('commande'));

    // Sauvegarder le PDF dans un chemin temporaire
    $pdfPath = storage_path('app/public/commandes/commande_' . $commande->id . '.pdf');
    $pdf->save($pdfPath);

    // Envoyer l'email avec le PDF en pièce jointe
    Mail::to($commande->client->email)
        ->send(new CommandePdfMail($commande->client, $commande, $pdfPath));

    // Retourner un message de succès après l'envoi
    return redirect()->route('commande.show', $commandeId)
        ->with('success_message', 'Commande envoyée par email avec succès !');
} 
    public function index()
    {
       
        $commandes = Commande::with(['client', 'produits'])->get();
        
        return view('commandes.index', compact('commandes'));
    }
   


    public function sendCommandePdf($commandeId)
    {
        $commande = Commande::find($commandeId);
        $client = $commande->client;
    
        // Générer le PDF (utilisez une bibliothèque comme domPDF ou barryvdh/laravel-dompdf)
        $pdf = PDF::loadView('pdf.commande', ['commande' => $commande, 'client' => $client]); // Exemple avec domPDF
    
        // Enregistrer le PDF dans le stockage temporaire
        $pdfPath = storage_path('app/public/commandes/' . $commande->id . '-commande.pdf');
        $pdf->save($pdfPath);
    
        // Envoyer l'email avec le PDF en pièce jointe
        Mail::to($client->email)->send(new CommandePdfMail($client, $commande, $pdfPath));
    }
public function updateStatut(Request $request, $id)
{
    $commande = Commande::findOrFail($id);
    $commande->statut = $request->statut;
    $commande->save();

    return response()->json(['success' => true]);
}
    
    public function indexA()
    {
       
        $commandes = Commande::with(['client', 'produits'])->get();
        
        return view('commandes.indexA', compact('commandes'));
    }

    
    // Affiche le formulaire de création d'une commande
    public function create($id)
    {
        // Récupère le produit spécifique par son ID
        $produit = Produit::findOrFail($id);

        // Retourne la vue avec le produit sélectionné
        return view('commandes.create', compact('produit'));
    }
    

    

    public function store(Request $request)
{
     
   // dd($request->all());
    // Validation des données
    $request->validate([
        'client_nom' => 'required|string|max:255',
        'client_prenom' => 'required|string|max:255',
        'client_email' => 'required|email',
        'client_telephone' => 'required|string|max:15',
        'produit_id' => 'required|exists:produits,id', // Validation que le produit existe
        'total' => 'required|numeric',
        'status' => 'required|in:en_attente,en_preparation,pret,termine', // Validation de l'état
        'nombre_de_pieces' => 'required|integer', // Validation du nombre de pièces
    ]);

    // Création ou récupération du client (vérifie si l'email existe déjà)
    $client = Client::firstOrCreate(
        ['email' => $request->client_email],
        [
            'prenom' => $request->client_prenom,
            'nom' => $request->client_nom,
            'telephone' => $request->client_telephone,
        ]
    );

   
    $commande = Commande::create([
        'total' => $request->total,
        'status' => $request->status,
        'nombre_de_pieces' => $request->nombre_de_pieces,
        'client_id' => $client->id,
        'produit_id' => $request->produit_id, // Ajout du produit
    ]);
    
    // Associe le produit à la commande dans la table pivot commande_produit
    $commande->produits()->attach($request->produit_id, ['quantite' => $request->nombre_de_pieces]);

    // Redirection vers la liste des commandes avec un message de succès
    return redirect()->route('client.index')->with('success_message', 'Commande créée avec succès !');
    session(['client_email' => $request->email]);

    // Générer le PDF
    $pdf = Pdf::loadView('pdf.commande', compact('commande'));
    $pdfPath = storage_path('app/public/factures/' . Str::random(10) . '.pdf');
    $pdf->save($pdfPath);

    // Envoyer l'email avec le PDF
    Mail::to($client->email)->send(new CommandeReussieMail($commande, $pdfPath));
}


public function show(Request $request)
{
   
        // Sinon, récupérer l'email depuis le formulaire GET
        $request->validate(['email' => 'required|email']);
        $email = $request->email;
    

    // Trouver le client
    $client = Client::where('email', $email)->first();

    // Vérifier si le client existe
    if (!$client) {
        return back()->with('error_message', 'Aucun client trouvé avec cet email.');
    }

    // Récupérer les commandes du client
    $commandes = $client->commandes;

    // Afficher les commandes du client
    return view('commandes.index', compact('commandes'));
}
public function destroy(Commande $commande)
{
    try {
        $commande->delete();
        return redirect()->route('commandes.index')->with('success_message', 'Commande supprimé avec succès!');
    } catch (\Exception $e) {
        return redirect()->route('commandes.index')->with('error_message', 'Erreur lors de la suppression du Commande.');
    }
}
public function destroyy(Commande $commande)
{
    try {
        $commande->delete();
        return redirect()->route('commandes.indexA')->with('success_message', 'Commande supprimé avec succès!');
    } catch (\Exception $e) {
        return redirect()->route('commandes.indexA')->with('error_message', 'Erreur lors de la suppression du Commande.');
    }
}



}
