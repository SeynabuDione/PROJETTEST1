<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function login(){
        return view('auth.login'); 
    }
    public function handleLogin(AuthRequest $request){
        //PERMET DE VOIR LES PARAMETRES QUI SONT CONSERNES PAR LE MOT DE PASSE
               // dd($request->only(['email','password'])); 
        //PERMET DE VOIR SI ON CETTE ENREGISTREMENT CORRESPOND A UN AUTRE ENREGISREMENT
        $credentials = $request->only(['email','password']);
        if(Auth::attempt($credentials)){
         return redirect()->route('dashboard');
 
        }else{
         return redirect()->back()->with('error_msg','Paramétre de connexion non reconnu');
        }

}
}
