<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matricula = Matricula::all();

        return response()->json($matricula);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'id_grupo' => 'required|exists:grupos,id_grupo',
            'id_estudiante' => 'required|exists:usuarios,id_usuario',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        // Crear la nueva matrícula
        $matricula = Matricula::create([
            'id_grupo' => $request->id_grupo,
            'id_estudiante' => $request->id_estudiante,
        ]);

        if (!$matricula) {
            $data = [
                'message' => 'Error al crear la matrícula',
                'status' => 500
            ];

            return response()->json($data, 500);
        }

        $data = [
            'matricula' => $matricula,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Matricula $matricula)
    {
        return response()->json($matricula);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'id_grupo' => 'required|exists:grupos,id_grupo',
            'id_estudiante' => 'required|exists:usuarios,id_usuario',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        // Buscar la matrícula por ID
        $matricula = Matricula::find($id);

        if (!$matricula) {
            $data = [
                'message' => 'Matrícula no encontrada',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        // Actualizar los datos de la matrícula
        $matricula->id_grupo = $request->id_grupo;
        $matricula->id_estudiante = $request->id_estudiante;

        if (!$matricula->save()) {
            $data = [
                'message' => 'Error al actualizar la matrícula',
                'status' => 500
            ];

            return response()->json($data, 500);
        }

        $data = [
            'matricula' => $matricula,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Matricula $matricula)
    {
        //
    }
}
