<?php

namespace App\Http\Controllers;

use App\Models\NotaExperienciaFormativa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotaExperienciaFormativaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notas = NotaExperienciaFormativa::with(['experienciaFormativa', 'estudiante', 'docente'])->get();
        return response()->json($notas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'nota' => 'required|integer',
            'id_experiencia' => 'required|exists:experiencias_formativas,id_experiencia',
            'id_estudiante' => 'required|exists:usuarios,id_usuario',
            'id_docente' => 'required|exists:usuarios,id_usuario',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        // Crear una nueva nota
        $nota = NotaExperienciaFormativa::create([
            'nota' => $request->nota,
            'id_experiencia' => $request->id_experiencia,
            'id_estudiante' => $request->id_estudiante,
            'id_docente' => $request->id_docente,
        ]);

        return response()->json([
            'nota' => $nota,
            'status' => 201
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $nota = NotaExperienciaFormativa::with(['experienciaFormativa', 'estudiante', 'docente'])->find($id);

        if (!$nota) {
            return response()->json([
                'message' => 'Nota no encontrada',
                'status' => 404
            ], 404);
        }

        return response()->json($nota);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'nota' => 'required|integer',
            'id_experiencia' => 'required|exists:experiencias_formativas,id_experiencia',
            'id_estudiante' => 'required|exists:usuarios,id_usuario',
            'id_docente' => 'required|exists:usuarios,id_usuario',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        // Encontrar el registro existente
        $nota = NotaExperienciaFormativa::find($id);

        if (!$nota) {
            return response()->json([
                'message' => 'Nota no encontrada',
                'status' => 404
            ], 404);
        }

        // Actualizar el registro
        $nota->nota = $request->nota;
        $nota->id_experiencia = $request->id_experiencia;
        $nota->id_estudiante = $request->id_estudiante;
        $nota->id_docente = $request->id_docente;
        $nota->save();

        return response()->json([
            'nota' => $nota,
            'status' => 200
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Encontrar el registro existente
        $nota = NotaExperienciaFormativa::find($id);

        if (!$nota) {
            return response()->json([
                'message' => 'Nota no encontrada',
                'status' => 404
            ], 404);
        }

        // Eliminar el registro
        $nota->delete();

        return response()->json([
            'message' => 'Nota eliminada exitosamente',
            'status' => 200
        ], 200);
    }
}
