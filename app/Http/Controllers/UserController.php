<?php

namespace App\Http\Controllers;

use App\Http\Requests\InscriptionRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function tableauDeBord(){
        return view('Authentification.tableauDeBord');
    }

    public function connexion(){
        return view('Authentification.connexion');
    }

    public function connexion_traitement(Request $request){
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect('/Dashboard
            ')->with('status', 'Vous êtes connecté!');
        }
        return back()->withInput()->with('status', 'Votre email ou mot de passe est incorrecte!');

    }

    public function inscription(){
        return view('Authentification.inscription');
    }

    public function inscription_traitement(InscriptionRequest $request){
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' =>Hash::make($request->password),
        ]);
        return redirect('/login');
    }

    public function deconnexion(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('status', 'Vous êtes déconnecté.');
    }
}
