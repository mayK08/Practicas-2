<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Empleado;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function username()
    {
        return 'email';
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        // Buscar empleado por email
        $email = $request->email;
        $empleado = Empleado::where('email', $email)->first();
        
        if (!$empleado) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => trans('passwords.user')]);
        }
        
        // Buscar usuario con el CURP del empleado
        $usuario = Usuario::where('curp', $empleado->curp)->first();
        
        if (!$usuario) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => trans('passwords.user')]);
        }
        
        // Eliminar tokens anteriores para este email
        DB::table('password_resets')->where('email', $empleado->email)->delete();
        
        // Crear token manualmente usando el email del empleado
        $token = Str::random(60);
        
        // Insertar directamente en password_resets con el email del empleado
        DB::table('password_resets')->insert([
            'email' => $empleado->email,
            'token' => bcrypt($token),
            'created_at' => now(),
        ]);
        
        // Enviar notificación usando el email del empleado
        $usuario->sendPasswordResetNotification($token);
        
        return back()->with('status', trans('passwords.sent'));
    }

    protected function validateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingresa un correo electrónico válido.',
        ]);
    }

    protected function credentials(Request $request)
    {
        return $request->only('email');
    }

    protected function sendResetLinkResponse(Request $request, $response)
    {
        return back()->with('status', trans($response));
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => trans($response)]);
    }

    public function broker()
    {
        return Password::broker('usuarios');
    }
}
