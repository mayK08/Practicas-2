<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Notifications\SolicitudAprobada;
use App\Notifications\SolicitudRechazada;

class SolicitudController extends Controller
{
    public function index()
    {
        $solicitudesPendientes = Empleado::where('solicitud_status', 'Pendiente')
            ->select('id', 'curp', 'apellido_paterno', 'apellido_materno', 'nombre', 'num_empleado', 'puesto', 'dependencia', 'created_at', 'solicitud_status')
            ->get();
            
        $solicitudesAceptadas = Empleado::where('solicitud_status', 'Aprobada')
            ->select('id', 'curp', 'apellido_paterno', 'apellido_materno', 'nombre', 'num_empleado', 'puesto', 'dependencia', 'updated_at', 'solicitud_status')
            ->get();
        
        $solicitudesRechazadas = Empleado::where('solicitud_status', 'Rechazada')
            ->select('id', 'curp', 'apellido_paterno', 'apellido_materno', 'nombre', 'num_empleado', 'puesto', 'dependencia', 'updated_at', 'solicitud_status', 'motivo_rechazo')
            ->get();
        
        return view('solicitudes.index', compact('solicitudesPendientes', 'solicitudesAceptadas', 'solicitudesRechazadas'));
    }

    public function aprobar(Empleado $empleado)
    {
        try {
            Log::info('Iniciando aprobación de solicitud con ID: ' . $empleado->id);
            
            // Verificar si ya existe un usuario para este empleado
            // Si CURP es nulo, validar por email para evitar duplicados
            $usuarioExistente = $empleado->curp
                ? Usuario::where('curp', $empleado->curp)->first()
                : Usuario::where('email', $empleado->email)->first();
            if ($usuarioExistente) {
                Log::warning('Ya existe un usuario para el empleado', [
                    'curp' => $empleado->curp,
                    'email' => $empleado->email
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Ya existe un usuario para este empleado'
                ], 400);
            }
            
            // Generar contraseña automática
            $password = Str::random(8); // Contraseña de 8 caracteres
            
            // Crear el usuario en la tabla usuarios
            $usuario = Usuario::create([
                'curp' => $empleado->curp, // puede ser null si no fue capturada
                'username' => $empleado->nombre . ' ' . $empleado->apellido_paterno,
                'email' => $empleado->email,
                'password_hash' => Hash::make($password),
                'rol' => 'capturador', // Rol por defecto
            ]);
            
            Log::info('Usuario creado exitosamente para CURP: ' . $empleado->curp . ' con contraseña: ' . $password);
            
            // Actualizar el empleado
            $empleado->solicitud_status = 'Aprobada';
            $empleado->status = 'Activo';
            $empleado->save();
            
            // Enviar notificación por correo con la contraseña
            try {
                $empleado->notify(new SolicitudAprobada($empleado, $password));
                Log::info('Notificación de aprobación enviada a: ' . $empleado->email);
            } catch (\Exception $emailError) {
                Log::error('Error al enviar correo de aprobación: ' . $emailError->getMessage(), [
                    'id' => $empleado->id,
                    'email' => $empleado->email,
                    'exception' => $emailError
                ]);
                // No devolvemos error al usuario si falla el correo, la solicitud ya fue aprobada
            }
            
            Log::info('Solicitud aprobada exitosamente para ID: ' . $empleado->id);

            return response()->json([
                'success' => true,
                'message' => 'Solicitud aprobada exitosamente, usuario creado y notificación enviada',
                'password' => $password // Solo para debugging, no enviar en producción
            ]);
        } catch (\Exception $e) {
            Log::error('Error al aprobar solicitud: ' . $e->getMessage(), [
                'id' => $empleado->id ?? null,
                'exception' => $e
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Error al aprobar la solicitud: ' . $e->getMessage()
            ], 500);
        }
    }

    public function rechazar(Request $request, Empleado $empleado)
    {
        try {
            Log::info('Iniciando rechazo de solicitud con ID: ' . $empleado->id, [
                'motivo' => $request->input('motivo')
            ]);
            
            $motivo = $request->input('motivo', 'No se especificó un motivo');
            
            $empleado->solicitud_status = 'Rechazada';
            $empleado->motivo_rechazo = $motivo;
            $empleado->save();
            
            // Enviar notificación por correo
            try {
                $empleado->notify(new SolicitudRechazada($empleado));
                Log::info('Notificación de rechazo enviada a: ' . $empleado->email);
            } catch (\Exception $emailError) {
                Log::error('Error al enviar correo de rechazo: ' . $emailError->getMessage(), [
                    'id' => $empleado->id,
                    'email' => $empleado->email,
                    'exception' => $emailError
                ]);
                // No devolvemos error al usuario si falla el correo, la solicitud ya fue rechazada
            }
            
            Log::info('Solicitud rechazada exitosamente para ID: ' . $empleado->id);

            return response()->json([
                'success' => true,
                'message' => 'Solicitud rechazada exitosamente y notificación enviada'
            ]);
        } catch (\Exception $e) {
            Log::error('Error al rechazar solicitud: ' . $e->getMessage(), [
                'id' => $empleado->id ?? null,
                'motivo' => $request->input('motivo'),
                'exception' => $e
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Error al rechazar la solicitud: ' . $e->getMessage()
            ], 500);
        }
    }
} 