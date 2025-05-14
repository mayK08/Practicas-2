<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Notifications\SolicitudAprobada;
use App\Notifications\SolicitudRechazada;

class SolicitudController extends Controller
{
    public function index()
    {
        $solicitudesPendientes = Empleado::where('solicitud_status', 'Pendiente')
            ->select('curp', 'apellido_paterno', 'apellido_materno', 'nombre', 'num_empleado', 'puesto', 'dependencia', 'created_at', 'solicitud_status')
            ->get();
            
        $solicitudesAceptadas = Empleado::where('solicitud_status', 'Aprobada')
            ->select('curp', 'apellido_paterno', 'apellido_materno', 'nombre', 'num_empleado', 'puesto', 'dependencia', 'updated_at', 'solicitud_status')
            ->get();
        
        $solicitudesRechazadas = Empleado::where('solicitud_status', 'Rechazada')
            ->select('curp', 'apellido_paterno', 'apellido_materno', 'nombre', 'num_empleado', 'puesto', 'dependencia', 'updated_at', 'solicitud_status', 'motivo_rechazo')
            ->get();
        
        return view('solicitudes.index', compact('solicitudesPendientes', 'solicitudesAceptadas', 'solicitudesRechazadas'));
    }

    public function aprobar($curp)
    {
        try {
            Log::info('Iniciando aprobación de solicitud con CURP: ' . $curp);
            
            // Verificar si el empleado existe
            $empleado = Empleado::where('curp', $curp)->first();
            
            if (!$empleado) {
                Log::error('No se encontró empleado con CURP: ' . $curp);
                return response()->json([
                    'success' => false,
                    'message' => 'No se encontró el empleado con CURP: ' . $curp
                ], 404);
            }
            
            $empleado->solicitud_status = 'Aprobada';
            $empleado->status = 'Activo';
            $empleado->save();
            
            // Enviar notificación por correo
            try {
                $empleado->notify(new SolicitudAprobada($empleado));
                Log::info('Notificación de aprobación enviada a: ' . $empleado->email);
            } catch (\Exception $emailError) {
                Log::error('Error al enviar correo de aprobación: ' . $emailError->getMessage(), [
                    'curp' => $curp,
                    'email' => $empleado->email,
                    'exception' => $emailError
                ]);
                // No devolvemos error al usuario si falla el correo, la solicitud ya fue aprobada
            }
            
            Log::info('Solicitud aprobada exitosamente para CURP: ' . $curp);

            return response()->json([
                'success' => true,
                'message' => 'Solicitud aprobada exitosamente y notificación enviada'
            ]);
        } catch (\Exception $e) {
            Log::error('Error al aprobar solicitud: ' . $e->getMessage(), [
                'curp' => $curp,
                'exception' => $e
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Error al aprobar la solicitud: ' . $e->getMessage()
            ], 500);
        }
    }

    public function rechazar(Request $request, $curp)
    {
        try {
            Log::info('Iniciando rechazo de solicitud con CURP: ' . $curp, [
                'motivo' => $request->input('motivo')
            ]);
            
            // Verificar si el empleado existe
            $empleado = Empleado::where('curp', $curp)->first();
            
            if (!$empleado) {
                Log::error('No se encontró empleado con CURP: ' . $curp);
                return response()->json([
                    'success' => false,
                    'message' => 'No se encontró el empleado con CURP: ' . $curp
                ], 404);
            }
            
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
                    'curp' => $curp,
                    'email' => $empleado->email,
                    'exception' => $emailError
                ]);
                // No devolvemos error al usuario si falla el correo, la solicitud ya fue rechazada
            }
            
            Log::info('Solicitud rechazada exitosamente para CURP: ' . $curp);

            return response()->json([
                'success' => true,
                'message' => 'Solicitud rechazada exitosamente y notificación enviada'
            ]);
        } catch (\Exception $e) {
            Log::error('Error al rechazar solicitud: ' . $e->getMessage(), [
                'curp' => $curp,
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