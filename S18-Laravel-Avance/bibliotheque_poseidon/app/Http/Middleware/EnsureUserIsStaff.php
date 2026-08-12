<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsStaff
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Vérification si l'utilisateur est connecté 
        if (!$user) {
            abort(403, "Vous devez être connecté (Middleware EnsureUserIsStaff)");
        }

        // Récupération du nom du role 
        $roleName = $user->role?->name;

        // Vérification si le role fait partie des accès
        if (!in_array($roleName, ['admin', 'staff'], true)) {
            abort(403, 'Accès non autorisé (Middleware EnsureUserIsStaff)');
        }

        return $next($request);
    }
}
