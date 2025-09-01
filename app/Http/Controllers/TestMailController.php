<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Empleado;
use App\Notifications\SolicitudAprobada;
use App\Notifications\SolicitudRechazada;

class TestMailController extends Controller
{
    public function index()
    {
        return view('test-mail');
    }

    public function test(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        try {
            // Crear un empleado de prueba
            $empleado = new Empleado([
                'curp' => 'TEST1234567890123456',
                'nombre' => 'Juan',
                'apellido_paterno' => 'Pérez',
                'apellido_materno' => 'García',
                'email' => $request->email,
                'solicitud_status' => 'Pendiente'
            ]);

            // Enviar notificación de aprobación
            $empleado->notify(new SolicitudAprobada($empleado));

            return redirect()->back()->with('success', 
                'Correo de prueba enviado exitosamente a ' . $request->email . '. 
                Verifica tu bandeja de entrada y carpeta de spam.'
            );

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 
                'Error al enviar correo: ' . $e->getMessage() . 
                '. Verifica la configuración en el archivo .env'
            );
        }
    }
} 