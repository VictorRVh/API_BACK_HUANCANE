<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permisos = Permiso::all();
        return response()->json($permisos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'nombre_permiso' => 'required|string|max:60',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        $permisos = Permiso::create([
            'nombre_permiso' => $request->nombre_permiso,
        ]);

        if (!$permisos) {
            $data = [
                'message' => 'Error al crear la especialidad',
                'status' => 500
            ];

            return response()->json($data, 500);
        }

        $data = [
            'permisos' => $permisos,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $permisos = Permiso::find($id);

        if (!$permisos) {
            return response()->json([
                'message' => 'Permiso no encontrado',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'permiso' => $permisos,
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
            'nombre_permiso' => 'required|string|max:60',
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
        $permisos = Permiso::find($id);

        if (!$permisos) {
            $data = [
                'message' => 'Rol no encontrado',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        // Actualizar el registro
        $permisos->nombre_permiso = $request->nombre_permiso;
        $permisos->save();

        return response()->json(['message' => 'Permiso actualizado', 'rol' => $permisos], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $permiso = Permiso::find($id);

        if (!$permiso) {
            return response()->json([
                'message' => 'Permiso no encontrado',
                'status' => 404
            ], 404);
        }

        $permiso->delete();

        return response()->json([
            'message' => 'Permiso eliminado exitosamente',
            'status' => 200
        ], 200);
    }
}
