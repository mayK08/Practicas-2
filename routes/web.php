<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TestMailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Rutas públicas
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/verificar-sesion', function() {
    return response()->json(['autenticado' => Auth::check()]);
})->name('verificar.sesion');

// Ruta de registro público
Route::get('/empleados/registro', function () {
    return view('empleados.registro');
})->name('empleados.registro');

// Ruta para procesar la solicitud de registro
Route::post('/api/empleados/solicitud', [EmpleadoController::class, 'store'])->name('empleados.solicitud');

// Ruta para la página de confirmación
Route::get('/empleados/confirmacion/{curp}', function ($curp) {
    $empleado = \App\Models\Empleado::findOrFail($curp);
    return view('empleados.confirmacion', compact('empleado'));
})->name('empleados.confirmacion');

// Rutas de recuperación de contraseña
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
    ->name('password.update');

// Rutas protegidas
Route::middleware(['auth'])->group(function () {
    // Ruta home (redirige según rol)
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // Rutas para administradores
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin', function () {
            return view('admin');
        })->name('admin');
        
        Route::get('/solicitudes', function () {
            return view('solicitudes.index');
        })->name('solicitudes.index');
    });
    
    // Rutas específicas para SuperAdmin
    Route::middleware(['role:SuperAdmin'])->group(function () {
        // Administración de usuarios (solo SuperAdmin)
        Route::get('/usuarios', [EmpleadoController::class, 'index'])->name('usuarios');
        
        // Acceso a panel de solicitudes para SuperAdmin también
        Route::get('/solicitudes-admin', function () {
            return view('solicitudes.index');
        })->name('solicitudes.admin');
    });

    // Rutas para capturadores
    Route::middleware(['role:capturador'])->group(function () {
        Route::get('/capturador', function () {
            return view('capturador');
        })->name('capturador');
        
        Route::get('/solicitudes-capturador', function () {
            return view('solicitudes');
        })->name('solicitudes.capturador');
        
        Route::get('/solicitudes-pendientes', function () {
            return view('solicitudes_pendientes');
        })->name('solicitudes.pendientes');
    });

    // Rutas para empleados
    Route::prefix('empleados')->group(function () {
        Route::match(['get', 'post'], '/', [EmpleadoController::class, 'index'])->name('empleados.index');
        Route::get('/recientes', [EmpleadoController::class, 'recientes'])->name('empleados.recientes');
        Route::get('/create', [EmpleadoController::class, 'create'])->name('empleados.create');
        Route::post('/', [EmpleadoController::class, 'store'])->name('empleados.store');
        Route::get('/{curp}/edit', [EmpleadoController::class, 'edit'])->name('empleados.edit');
        Route::put('/{curp}', [EmpleadoController::class, 'update'])->name('empleados.update');
        Route::delete('/{curp}', [EmpleadoController::class, 'destroy'])->name('empleados.destroy');
        Route::post('/{curp}/cambiar-estado', [EmpleadoController::class, 'cambiarEstado'])->name('empleados.cambiarEstado');
        Route::get('/exportar/excel', [EmpleadoController::class, 'exportarExcel'])->name('empleados.exportar-excel');
        Route::get('/exportar/pdf', [EmpleadoController::class, 'exportarPDF'])->name('empleados.exportar-pdf');
        Route::get('/check-data', [EmpleadoController::class, 'checkData'])->name('empleados.check-data');
    });

    // Rutas para solicitudes
    Route::get('/solicitudes', [SolicitudController::class, 'index'])->name('solicitudes.index');
    Route::post('/solicitudes/{curp}/aprobar', [SolicitudController::class, 'aprobar'])->name('solicitudes.aprobar');
    Route::post('/solicitudes/{curp}/rechazar', [SolicitudController::class, 'rechazar'])->name('solicitudes.rechazar');

    // Rutas para gestión de usuarios y roles
    Route::prefix('usuarios')->group(function () {
        Route::get('/gestion-roles', [UsuarioController::class, 'index'])->name('usuarios.gestion-roles');
        Route::get('/{curp}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
        Route::put('/{curp}', [UsuarioController::class, 'update'])->name('usuarios.update');
        Route::post('/{curp}/cambiar-rol', [UsuarioController::class, 'cambiarRol'])->name('usuarios.cambiar-rol');
        Route::get('/get-usuarios', [UsuarioController::class, 'getUsuarios'])->name('usuarios.get-usuarios');
    });
});

// Rutas para prueba de correos
Route::get('/test-mail', [TestMailController::class, 'index'])->name('test.mail');
Route::post('/test-mail', [TestMailController::class, 'test'])->name('test.mail.send');
