<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rol = Rol::all();
        return response()->json($rol);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'rol' => 'required|string|max:60',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        $rol = Rol::create([
            'rol' => $request->rol,
        ]);

        if (!$rol) {
            $data = [
                'message' => 'Error al crear la especialidad',
                'status' => 500
            ];

            return response()->json($data, 500);
        }

        $data = [
            'rol' => $rol,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $rol = Rol::find($id);

        if (!$rol) {
            return response()->json([
                'message' => 'Rol no encontrado',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'rol' => $rol,
            'status' => 200
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'rol' => 'required|string|max:60',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        // Encontrar el registro existente
        $roles = Rol::find($id);

        if (!$roles) {
            $data = [
                'message' => 'Rol no encontrado',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        // Actualizar el registro
        $roles->rol = $request->rol;
        $roles->save();

        return response()->json(['message' => 'Rol actualizado', 'rol' => $roles], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rol = Rol::find($id);

        if (!$rol) {
            return response()->json([
                'message' => 'Rol no encontrado',
                'status' => 404
            ], 404);
        }

        $rol->delete();

        return response()->json([
            'message' => 'Rol eliminado exitosamente',
            'status' => 200
        ], 200);
    }
}
