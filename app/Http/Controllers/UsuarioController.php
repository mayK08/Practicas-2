<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UsuarioController extends Controller
{
    /**
     * Muestra el listado de usuarios con sus roles
     */
    public function index()
    {
        try {
            // Obtener todos los usuarios con información del empleado relacionado
            $usuarios = Usuario::with('empleado')->get();
            
            return view('usuarios.gestion-roles', compact('usuarios'));
        } catch (\Exception $e) {
            Log::error('Error al obtener usuarios: ' . $e->getMessage());
            return back()->with('error', 'Error al obtener los usuarios: ' . $e->getMessage());
        }
    }

    /**
     * Muestra el formulario para editar el rol de un usuario
     */
    public function edit($curp)
    {
        try {
            $usuario = Usuario::with('empleado')->where('curp', $curp)->first();
            
            if (!$usuario) {
                return back()->with('error', 'Usuario no encontrado');
            }
            
            return view('usuarios.editar-rol', compact('usuario'));
        } catch (\Exception $e) {
            Log::error('Error al obtener usuario: ' . $e->getMessage());
            return back()->with('error', 'Error al obtener el usuario: ' . $e->getMessage());
        }
    }

    /**
     * Actualiza el rol de un usuario
     */
    public function update(Request $request, $curp)
    {
        try {
            $request->validate([
                'rol' => 'required|in:capturador,admin,SuperAdmin'
            ]);

            $usuario = Usuario::where('curp', $curp)->first();
            
            if (!$usuario) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuario no encontrado'
                ], 404);
            }

            $rolAnterior = $usuario->rol;
            $usuario->rol = $request->rol;
            $usuario->save();

            Log::info('Rol de usuario actualizado', [
                'curp' => $curp,
                'rol_anterior' => $rolAnterior,
                'rol_nuevo' => $request->rol,
                'usuario_que_cambio' => auth()->user()->username ?? 'Sistema'
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Rol actualizado exitosamente',
                    'usuario' => $usuario->load('empleado')
                ]);
            }

            return redirect()->route('usuarios.gestion-roles')->with('success', 'Rol actualizado exitosamente');
        } catch (\Exception $e) {
            Log::error('Error al actualizar rol: ' . $e->getMessage());
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al actualizar el rol: ' . $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Error al actualizar el rol: ' . $e->getMessage());
        }
    }

    /**
     * Cambia el rol de un usuario via AJAX
     */
    public function cambiarRol(Request $request, $curp)
    {
        try {
            $request->validate([
                'rol' => 'required|in:capturador,admin,SuperAdmin'
            ]);

            $usuario = Usuario::where('curp', $curp)->first();
            
            if (!$usuario) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuario no encontrado'
                ], 404);
            }

            $rolAnterior = $usuario->rol;
            $usuario->rol = $request->rol;
            $usuario->save();

            Log::info('Rol de usuario actualizado via AJAX', [
                'curp' => $curp,
                'rol_anterior' => $rolAnterior,
                'rol_nuevo' => $request->rol,
                'usuario_que_cambio' => auth()->user()->username ?? 'Sistema'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Rol actualizado exitosamente',
                'usuario' => $usuario->load('empleado')
            ]);
        } catch (\Exception $e) {
            Log::error('Error al cambiar rol via AJAX: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al cambiar el rol: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtiene la lista de usuarios para AJAX
     */
    public function getUsuarios()
    {
        try {
            $usuarios = Usuario::with('empleado')->get();
            
            return response()->json([
                'success' => true,
                'data' => $usuarios
            ]);
        } catch (\Exception $e) {
            Log::error('Error al obtener usuarios via AJAX: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener usuarios: ' . $e->getMessage()
            ], 500);
        }
    }
}
