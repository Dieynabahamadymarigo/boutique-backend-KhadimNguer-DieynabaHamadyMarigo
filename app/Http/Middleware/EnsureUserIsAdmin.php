<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// Vérifie que l'user connecté est admiin

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pas connecté -> redirige vers login
        if(!$request->user()){
            return redirect()->route('login');
            }

        // Connecté mais pas admin -> erreur 403
        if(!$request->user()->is_admin){
            abort(403,'🚫 Accès réservé aux administrateurs');
        }

        return $next($request);
    }
}
