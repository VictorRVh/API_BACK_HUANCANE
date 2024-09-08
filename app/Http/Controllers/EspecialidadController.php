<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EspecialidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $especialidades = Especialidad::all();

        return response()->json([
            'status' => 200,
            'especialidades' => $especialidades
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'nombre_especialidad' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        // Crear el nuevo registro de especialidad
        $especialidad = Especialidad::create([
            'nombre_especialidad' => $request->nombre_especialidad,
        ]);

        if (!$especialidad) {
            $data = [
                'message' => 'Error al crear la especialidad',
                'status' => 500
            ];

            return response()->json($data, 500);
        }

        $data = [
            'especialidad' => $especialidad,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */


    public function show($id)
    {
        $especialidad = Especialidad::find($id);

        if (!$especialidad) {
            return response()->json([
                'message' => 'Especialidad no encontrada',
                'status' => 404,
            ], 404);
        }

        return response()->json($especialidad, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'nombre_especialidad' => 'required|string|max:255',
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
        $especialidad = Especialidad::find($id);

        if (!$especialidad) {
            $data = [
                'message' => 'Especialidad no encontrada',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        // Actualizar el registro
        $especialidad->nombre_especialidad = $request->nombre_especialidad;
        $especialidad->save();

        $data = [
            'message' => 'Especialidad actualizada',
            'especialidad' => $especialidad,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $especialidad = Especialidad::find($id);

        if (!$especialidad) {
            return response()->json([
                'status' => 404,
                'message' => 'Especialidad no encontrada'
            ], 404);
        }

        $especialidad->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Especialidad eliminada correctamente'
        ], 200);
    }
}
