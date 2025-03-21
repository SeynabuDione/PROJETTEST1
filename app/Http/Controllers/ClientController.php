<?php

namespace App\Http\Controllers;

use App\Models\Produit;

class ClientController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        
        $produits = Produit::all();

        
        return view('Client.index', compact('produits'));
    }

  public function productDetails($id)
{
    
    $produit = Produit::findOrFail($id);


    return view('Client.product-details', compact('produit'));
}

}
