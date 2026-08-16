<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\AuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    public function register(AuthRequest $request){
        $data = $request->validated();
        $user = new User;
        $user->username = $data['nom'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->save();
        return redirect('/')->with('success', 'Bienvenue');
    }

    public function login(){
        return view('auth.connexion');
    }

    public function login_now(AuthRequest $request){
        $data = $request->validated();
        if(Auth::attempt($data)){
            return redirect()->intended('/')->with('success', 'Bon retour');
        }
        return to_route('connexion')->withErrors([
            'email' => 'Informations incorrectes'
        ])->onlyInput('email');
    }
}
