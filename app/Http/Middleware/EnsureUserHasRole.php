<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    // ...$roles est une table qui va contenir la liste des rôles qu'on autorise et string devant indique que chaque role est un string

    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Si un user n'est pas connectée OU SI (son rôle n'est pas dans la liste autorisée), alors bloque avec une erreur 403."

        if(!$request->user() || !$request->user()->hasRole($roles)){
            abort(403,'🚫 Accès non autorisé');
        }
        return $next($request);
        
        // Sinon, laisse passer, continue vers la page demandée.
    }
}
