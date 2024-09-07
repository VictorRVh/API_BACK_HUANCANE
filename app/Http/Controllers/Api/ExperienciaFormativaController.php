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
        $experienciaFormativa = ExperienciaFormativa::all();

        return response()->json($experienciaFormativa);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'nombre_experiencia' => 'required|string|max:255',
            'id_programa' => 'required|exists:programas,id_programa',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        // Crear el nuevo registro de experiencia formativa
        $experienciaFormativa = ExperienciaFormativa::create([
            'nombre_experiencia' => $request->nombre_experiencia,
            'id_programa' => $request->id_programa,
        ]);

        if (!$experienciaFormativa) {
            $data = [
                'message' => 'Error al crear la experiencia formativa',
                'status' => 500
            ];

            return response()->json($data, 500);
        }

        $data = [
            'experiencia_formativa' => $experienciaFormativa,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ExperienciaFormativa $experienciaFormativa)
    {
        return response()->json($experienciaFormativa);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'nombre_experiencia' => 'required|string|max:255',
            'id_programa' => 'required|exists:programas,id_programa',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        // Buscar la experiencia formativa por ID
        $experienciaFormativa = ExperienciaFormativa::find($id);

        if (!$experienciaFormativa) {
            $data = [
                'message' => 'Experiencia formativa no encontrada',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        // Actualizar los datos de la experiencia formativa
        $experienciaFormativa->nombre_experiencia = $request->nombre_experiencia;
        $experienciaFormativa->id_programa = $request->id_programa;

        if (!$experienciaFormativa->save()) {
            $data = [
                'message' => 'Error al actualizar la experiencia formativa',
                'status' => 500
            ];

            return response()->json($data, 500);
        }

        $data = [
            'experiencia_formativa' => $experienciaFormativa,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExperienciaFormativa $experienciaFormativa)
    {
        //
    }
}
