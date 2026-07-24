<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Affiche le formulaire de connexion. Middleware guest: redirige si déjà connecté
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Traite la soumission du formulaire de connexion
     */
    public function store(Request $request): RedirectResponse{
        // valide email + password
        $credentials=$request->validate([
            'email'=>['required','email'],
            'password'=>['required'],
        ]);

        // Regenere la session si succès
        if(Auth::attempt($credentials, $request->boolean('remember'))){
            $request->session()->regenerate();

            return redirect()->intended(route('home'));
        }

        // Echec -> retour avec erreur
        return back()->withErrors([
            'email'=>'Identifiants incorrects',
        ])->onlyInput('email');
    }
    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     $request->authenticate();

    //     $request->session()->regenerate();

    //     return redirect()->intended(route('home', absolute: false));
    // }

    /**
     * Deconnexion
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
