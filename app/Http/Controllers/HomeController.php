<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Redirige a los usuarios según su rol.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(): RedirectResponse
    {
        $user = Auth::user();
        
        // Depurar información del usuario en HomeController
        Log::info('HomeController: Usuario autenticado', [
            'id' => $user->id,
            'curp' => $user->curp, 
            'username' => $user->username,
            'rol' => $user->rol,
        ]);
        
        switch ($user->rol) {
            case 'SuperAdmin':
                Log::info('HomeController: Redirigiendo SuperAdmin a: ' . route('usuarios'));
                return redirect()->route('usuarios');
            case 'admin':
                Log::info('HomeController: Redirigiendo admin a: ' . route('admin'));
                return redirect()->route('admin');
            case 'capturador':
                Log::info('HomeController: Redirigiendo capturador a: ' . route('capturador'));
                return redirect()->route('capturador');
            default:
                // Fallback si no hay un rol definido
                Log::info('HomeController: Redirigiendo rol desconocido a: /');
                return redirect('/');
        }
    }
}
