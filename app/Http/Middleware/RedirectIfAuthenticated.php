<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Redirigir según el rol del usuario
                $user = Auth::guard($guard)->user();
                
                // Depurar información del usuario en RedirectIfAuthenticated
                Log::info('RedirectIfAuthenticated middleware: Usuario autenticado', [
                    'url' => $request->url(),
                    'path' => $request->path(),
                    'id' => $user->id,
                    'curp' => $user->curp,
                    'username' => $user->username,
                    'rol' => $user->rol,
                ]);
                
                switch ($user->rol) {
                    case 'SuperAdmin':
                        Log::info('RedirectIfAuthenticated: Redirigiendo SuperAdmin a: ' . route('usuarios'));
                        return redirect()->route('usuarios');
                    case 'admin':
                        Log::info('RedirectIfAuthenticated: Redirigiendo admin a: ' . route('admin'));
                        return redirect()->route('admin');
                    case 'capturador':
                        Log::info('RedirectIfAuthenticated: Redirigiendo capturador a: ' . route('capturador'));
                        return redirect()->route('capturador');
                    default:
                        Log::info('RedirectIfAuthenticated: Redirigiendo rol desconocido a: ' . RouteServiceProvider::HOME);
                return redirect(RouteServiceProvider::HOME);
                }
            }
        }
        return $next($request);
    }
}
