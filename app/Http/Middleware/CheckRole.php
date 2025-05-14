<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    
    {
        if (!$request->user()) {
            abort(403, 'No estás autenticado.');
        }
        
        // Si solo se pasa un rol como string (formato antiguo)
        if (count($roles) === 1 && strpos($roles[0], ',') !== false) {
            $roles = explode(',', $roles[0]);
        }
        
        if (!in_array($request->user()->rol, $roles)) {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }

        return $next($request);
    }
} 