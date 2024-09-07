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
        $notas = NotaExperienciaFormativa::all();
        return response()->json($notas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'id_experiencia' => 'required|exists:experiencias_formativas,id_experiencia',
            'id_estudiante' => 'required|exists:usuarios,id_usuario',
            'id_docente' => 'required|exists:usuarios,id_usuario',
            'nota' => 'required|integer|min:0|max:100'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        // Crear la nueva nota de experiencia formativa
        $nota = NotaExperienciaFormativa::create([
            'id_experiencia' => $request->id_experiencia,
            'id_estudiante' => $request->id_estudiante,
            'id_docente' => $request->id_docente,
            'nota' => $request->nota,
        ]);

        if (!$nota) {
            $data = [
                'message' => 'Error al crear la nota de experiencia formativa',
                'status' => 500
            ];

            return response()->json($data, 500);
        }

        $data = [
            'nota' => $nota,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(NotaExperienciaFormativa $notaExperienciaFormativa)
    {
        return response()->json($notaExperienciaFormativa);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'id_experiencia' => 'required|exists:experiencias_formativas,id_experiencia',
            'id_estudiante' => 'required|exists:usuarios,id_usuario',
            'id_docente' => 'required|exists:usuarios,id_usuario',
            'nota' => 'required|integer|min:0|max:100'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        // Buscar la nota de experiencia formativa por ID
        $nota = NotaExperienciaFormativa::find($id);

        if (!$nota) {
            $data = [
                'message' => 'Nota de experiencia formativa no encontrada',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        // Actualizar los datos de la nota
        $nota->id_experiencia = $request->id_experiencia;
        $nota->id_estudiante = $request->id_estudiante;
        $nota->id_docente = $request->id_docente;
        $nota->nota = $request->nota;

        if (!$nota->save()) {
            $data = [
                'message' => 'Error al actualizar la nota de experiencia formativa',
                'status' => 500
            ];

            return response()->json($data, 500);
        }

        $data = [
            'nota' => $nota,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NotaExperienciaFormativa $notaExperienciaFormativa)
    {
        //
    }
}
