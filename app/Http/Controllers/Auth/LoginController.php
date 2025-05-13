<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'curp' => ['required'],
            'password' => ['required'],
        ]);

        // Intentar autenticar usando el campo username
        if (Auth::attempt(['curp' => $credentials['curp'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            
            // Redirigir según el rol
            $user = Auth::user();
            switch($user->rol) {
                case 'admin':
                    return redirect()->route('admin');
                case 'capturador':
                    return redirect()->route('capturador');
                default:
                    return redirect()->route('home');
            }
        }

        return back()->withErrors([
            'username' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->withInput($request->only('username'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
} 