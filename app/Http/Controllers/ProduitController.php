<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProduitRequest;
use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    /**
     * Affiche la liste des produits.
     */
    public function index()
    {
        $produits = Produit::all();
        return view('produits.index', compact('produits'));
    }

    /**
     * Affiche le formulaire de création d’un produit.
     */
    public function create()
    {
        return view('produits.create');
    }

    /**
     * Enregistre un nouveau produit dans la base de données.
     */
    public function store(StoreProduitRequest $request)
    {
        // Création d'un nouveau produit
        $produit = new Produit();
        $produit->nom = $request->input('nom');
        $produit->prix = $request->input('prix');
        $produit->description = $request->input('description');

        // Gestion de l'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $produit->image = basename($imagePath);
        }

        // Sauvegarde en base de données
        $produit->save();

        return redirect()->route('produits.index')->with('success_message', 'Produit ajouté avec succès!');
    }

    /**
     * Affiche les détails d'un produit spécifique.
     */
    public function show(Produit $produit)
    {
        return view('produits.show', compact('produit'));
    }

    /**
     * Affiche le formulaire de modification d’un produit.
     */
    public function edit(Produit $produit)
    {
        return view('produits.edit', compact('produit'));
    }

    /**
     * Met à jour les informations d’un produit.
     */
    public function update(Request $request, Produit $produit)
    {
        // Validation des données
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ]);

        // Mise à jour des champs
        $produit->nom = $request->input('nom');
        $produit->prix = $request->input('prix');
        $produit->description = $request->input('description');

        // Gestion de l'image (mise à jour si une nouvelle est téléchargée)
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $produit->image = basename($imagePath);
        }

        // Enregistrement en base de données
        $produit->save();

        
        return redirect()->route('produits.index')->with('success_message', 'Produit mis à jour avec succès!');
    }

    /**
     * Supprime un produit de la base de données.
     */
    public function destroy(Produit $produit)
    {
        try {
            $produit->delete();
            return redirect()->route('produits.index')->with('success_message', 'Produit supprimé avec succès!');
        } catch (\Exception $e) {
            return redirect()->route('produits.index')->with('error_message', 'Erreur lors de la suppression du produit.');
        }
    }
}
