<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommandeController;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use App\Models\Commande;

// Route pour la page de connexion
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'handleLogin'])->name('handleLogin');

// Routes sécurisées pour l'admin
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AppController::class, 'index'])->name('dashboard');

    // Routes Produits (Admin)
    Route::prefix('produits')->group(function () {
        Route::get('/', [ProduitController::class, 'index'])->name('produit.index');
        Route::get('/create', [ProduitController::class, 'create'])->name('produit.create');
        Route::post('/store', [ProduitController::class, 'store'])->name('produit.store');
        Route::get('/edit/{produit}', [ProduitController::class, 'edit'])->name('produit.edit');
        Route::delete('/delete/{produit}', [ProduitController::class, 'delete'])->name('produit.delete');
    });

    // Routes Commandes (Admin)
    Route::prefix('commandes')->group(function () {
        Route::get('/', [CommandeController::class, 'indexA'])->name('commandes.indexA');
        Route::post('/{id}/update-status', [CommandeController::class, 'updateStatus'])->name('commandes.updateStatus');
        Route::get('/edit/{commande}', [CommandeController::class, 'edit'])->name('commandes.edit');
        Route::delete('/destroy/{commande}', [CommandeController::class, 'destroy'])->name('commandes.destroy');
        Route::delete('/destroyy/{commande}', [CommandeController::class, 'destroyy'])->name('commandes.destroyy');
        Route::get('/', [CommandeController::class, 'index'])->name('commandes.index');
        Route::get('/commandes', [CommandeController::class, 'indexA'])->name('commandes.indexA');
        
    });
});

// Routes publiques pour les clients
Route::get('/client', [ClientController::class, 'index'])->name('client.index');

// Route pour afficher un produit spécifique (client)
Route::get('/produit/{id}', [ClientController::class, 'productDetails'])->name('produit.details');

// Routes pour les commandes (Client)
Route::prefix('commandes')->group(function () {
  
    
    Route::get('/commandes', [CommandeController::class, 'index'])->name('commandes.index');

    
    Route::get('/commandes', [CommandeController::class, 'indexA'])->name('commandes.indexA');
    Route::get('/create/{id}', [CommandeController::class, 'create'])->name('commandes.create');
    Route::post('/store', [CommandeController::class, 'store'])->name('commandes.store');
    
    Route::post('/commandes/{id}/update-statut', [CommandeController::class, 'updateStatut']);
    
    Route::get('/facture/{id}', function ($id) {
      $commande = Commande::findOrFail($id);
      $pdf = Pdf::loadView('pdf.commande', compact('commande'));
      return $pdf->download('facture_' . $commande->id . '.pdf');
  })->name('telecharger.facture');
    
  Route::post('/commandes/{id}/update-statut', [CommandeController::class, 'updateStatut'])->name('commandes.updateStatut');

// routes/web.php
Route::get('/test-email', [CommandeController::class, 'testEmail']);
Route::post('/commandes/{id}/generate-pdf', [CommandeController::class, 'generatePdf'])->name('commandes.generatePdf');
Route::get('/commande/{commandeId}/generate-pdf', [CommandeController::class, 'generatePdf']);
Route::post('/commande/{id}/envoyer-email', [CommandeController::class, 'sendEmail'])->name('commande.sendEmail');



});