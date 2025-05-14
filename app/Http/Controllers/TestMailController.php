<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class TestMailController extends Controller
{
    public function enviarCorreoPrueba(Request $request)
    {
        try {
            // Validar el email destinatario
            $request->validate([
                'email' => 'required|email'
            ]);
            
            $destinatario = $request->input('email');
            
            // Información para el correo
            $data = [
                'subject' => 'Correo de Prueba - Declaranet Sonora',
                'name' => 'Usuario de Prueba',
            ];
            
            // Enviar el correo usando una closure
            Mail::send([], [], function ($message) use ($data, $destinatario) {
                $message->to($destinatario)
                    ->subject($data['subject'])
                    ->html('
                        <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px;">
                            <h2 style="color: #333;">Correo de Prueba</h2>
                            <p>Este es un correo de prueba enviado desde la aplicación Declaranet Sonora.</p>
                            <p>Si estás recibiendo este correo, significa que la configuración de correo está funcionando correctamente.</p>
                            <hr style="border: 1px solid #eee;">
                            <p style="color: #666; font-size: 12px;">Este correo fue enviado automáticamente, por favor no responda a este mensaje.</p>
                        </div>
                    ');
            });
            
            // Registro y respuesta
            Log::info('Correo de prueba enviado a: ' . $destinatario);
            
            return response()->json([
                'success' => true,
                'message' => 'Correo de prueba enviado correctamente a ' . $destinatario
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error al enviar correo de prueba: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error al enviar correo de prueba: ' . $e->getMessage()
            ], 500);
        }
    }
} 