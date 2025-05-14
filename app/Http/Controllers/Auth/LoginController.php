<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
    
    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('login');
    }
    
    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'curp';
    }
    
    /**
     * Get the post login redirect path.
     *
     * @return string
     */
    protected function redirectTo()
    {
        // Redireccionar según el rol del usuario
        if (Auth::check()) {
            $user = Auth::user();
            
            // Depurar información del usuario
            Log::info('Redirigiendo usuario después de login', [
                'id' => $user->id,
                'curp' => $user->curp,
                'username' => $user->username,
                'rol' => $user->rol,
            ]);
            
            switch ($user->rol) {
                case 'SuperAdmin':
                    Log::info('Usuario SuperAdmin redirigido a: ' . route('usuarios'));
                    return route('usuarios');
                case 'admin':
                    Log::info('Usuario admin redirigido a: ' . route('admin'));
                    return route('admin');
                case 'capturador':
                    Log::info('Usuario capturador redirigido a: ' . route('capturador'));
                    return route('capturador');
                default:
                    Log::info('Usuario con rol desconocido redirigido a: /home');          
                    return '/home';
            }
        }
        
        return '/home';
    }
    
    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);
        
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }
        
        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);
        
        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Obtener el nombre de usuario antes de cerrar sesión
        $userName = Auth::user() ? Auth::user()->username : 'Usuario';
        
        // Cerrar sesión
        Auth::logout();
        
        // Invalidar la sesión y regenerar el token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Redirigir a login con un mensaje
        return redirect()->route('login')
            ->with('message', 'La sesión de ' . $userName . ' se ha cerrado correctamente.')
            ->with('alert-type', 'success');
    }
}
