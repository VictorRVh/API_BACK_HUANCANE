<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::with('rol')->get();
        return response()->json($usuarios);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|string|max:255|unique:usuarios,dni',
            'email' => 'required|email|max:255|unique:usuarios,email',
            'telefono' => 'nullable|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'contrasena' => 'required|string|min:8',
            'id_rol' => 'required|exists:roles,id_rol',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        // Crear un nuevo usuario
        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'dni' => $request->dni,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'contrasena' => Hash::make($request->contrasena),
            'id_rol' => $request->id_rol,
        ]);

        return response()->json([
            'usuario' => $usuario,
            'status' => 201
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $usuario = Usuario::with('rol')->find($id);

        if (!$usuario) {
            return response()->json([
                'message' => 'Usuario no encontrado',
                'status' => 404
            ], 404);
        }

        return response()->json($usuario);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_usuario)
    {
        // Encontrar el usuario existente por ID
        $usuario = Usuario::find($id_usuario);

        if (!$usuario) {
            return response()->json([
                'message' => 'Usuario no encontrado',
                'status' => 404
            ], 404);
        }

        // Validación de datos
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|string|max:255|unique:usuarios,dni,' . $usuario->id_usuario . ',id_usuario',
            'email' => 'required|email|max:255|unique:usuarios,email,' . $usuario->id_usuario . ',id_usuario',
            'telefono' => 'nullable|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'contrasena' => 'nullable|string|min:8',
            'id_rol' => 'required|exists:roles,id_rol'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        // Actualizar el usuario
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->dni = $request->dni;
        $usuario->email = $request->email;
        $usuario->telefono = $request->telefono;
        $usuario->direccion = $request->direccion;

        if ($request->has('contrasena')) {
            $usuario->contrasena = Hash::make($request->contrasena);
        }

        $usuario->id_rol = $request->id_rol;
        $usuario->save();

        return response()->json([
            'message' => 'Usuario actualizado',
            'usuario' => $usuario,
            'status' => 200
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Encontrar el usuario existente
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json([
                'message' => 'Usuario no encontrado',
                'status' => 404
            ], 404);
        }

        // Eliminar el usuario
        $usuario->delete();

        return response()->json([
            'message' => 'Usuario eliminado exitosamente',
            'status' => 200
        ], 200);
    }
}
