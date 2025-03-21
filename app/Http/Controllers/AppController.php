<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Produit; 
use App\Models\Commande; 

class AppController extends Controller
{
    public function index(){
        $totalProduits = Produit::all()->count();
        $totalCommandes= Commande::all()->count();
        $totalClients= Client::all()->count();
       
        return view ('dashboard',compact('totalProduits','totalCommandes','totalClients'));
       
        
    }
}
