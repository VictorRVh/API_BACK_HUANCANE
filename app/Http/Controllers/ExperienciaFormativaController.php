<?php

namespace App\Http\Controllers;

use App\Models\ExperienciaFormativa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExperienciaFormativaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Incluye la relación con el programa asociado
        $experiencias = ExperienciaFormativa::with('programa')->get();
        return response()->json($experiencias, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación
        $validator = Validator::make($request->all(), [
            'nombre_experiencia' => 'required|string|max:255',
            'id_programa' => 'required|exists:programas,id_programa',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400,
            ], 400);
        }

        // Crear la experiencia formativa
        $experiencia = ExperienciaFormativa::create($request->all());

        return response()->json([
            'message' => 'Experiencia formativa creada exitosamente',
            'experiencia' => $experiencia,
            'status' => 201,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Incluye la relación con el programa asociado
        $experiencia = ExperienciaFormativa::with('programa')->find($id);

        if (!$experiencia) {
            return response()->json([
                'message' => 'Experiencia formativa no encontrada',
                'status' => 404,
            ], 404);
        }

        return response()->json($experiencia, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $experiencia = ExperienciaFormativa::find($id);

        if (!$experiencia) {
            return response()->json([
                'message' => 'Experiencia formativa no encontrada',
                'status' => 404,
            ], 404);
        }

        // Validación
        $validator = Validator::make($request->all(), [
            'nombre_experiencia' => 'string|max:255',
            'id_programa' => 'exists:programas,id_programa',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400,
            ], 400);
        }

        // Actualizar la experiencia formativa
        $experiencia->update($request->all());

        return response()->json([
            'message' => 'Experiencia formativa actualizada exitosamente',
            'experiencia' => $experiencia,
            'status' => 200,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $experiencia = ExperienciaFormativa::find($id);

        if (!$experiencia) {
            return response()->json([
                'message' => 'Experiencia formativa no encontrada',
                'status' => 404,
            ], 404);
        }

        // Eliminar la experiencia formativa
        $experiencia->delete();

        return response()->json([
            'message' => 'Experiencia formativa eliminada exitosamente',
            'status' => 200,
        ], 200);
    }
}
