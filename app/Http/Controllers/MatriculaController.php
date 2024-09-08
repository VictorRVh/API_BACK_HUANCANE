<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MatriculaController extends Controller
{
    public function index()
    {
        $matriculas = Matricula::with(['grupos', 'usuario'])->get();
        return response()->json($matriculas);
    }

    public function store(Request $request)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'id_grupo' => 'required|exists:grupos,id_grupo',
            'id_estudiante' => 'required|exists:usuarios,id_usuario',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        // Crear una nueva matricula
        $matricula = Matricula::create([
            'id_grupo' => $request->id_grupo,
            'id_estudiante' => $request->id_estudiante,
        ]);

        return response()->json([
            'matricula' => $matricula,
            'status' => 201
        ], 201);
    }

    public function show($id)
    {
        $matricula = Matricula::with(['grupos', 'usuario'])->find($id);

        if (!$matricula) {
            return response()->json([
                'message' => 'Matricula no encontrada',
                'status' => 404
            ], 404);
        }

        return response()->json($matricula);
    }

    public function update(Request $request, $id)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'id_grupo' => 'required|exists:grupos,id_grupo',
            'id_estudiante' => 'required|exists:usuarios,id_usuario',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        // Encontrar el registro existente
        $matricula = Matricula::find($id);

        if (!$matricula) {
            return response()->json([
                'message' => 'Matricula no encontrada',
                'status' => 404
            ], 404);
        }

        // Actualizar el registro
        $matricula->id_grupo = $request->id_grupo;
        $matricula->id_estudiante = $request->id_estudiante;
        $matricula->save();

        return response()->json([
            'matricula' => $matricula,
            'status' => 200
        ], 200);
    }

    public function destroy($id)
    {
        // Encontrar el registro existente
        $matricula = Matricula::find($id);

        if (!$matricula) {
            return response()->json([
                'message' => 'Matricula no encontrada',
                'status' => 404
            ], 404);
        }

        // Eliminar el registro
        $matricula->delete();

        return response()->json([
            'message' => 'Matricula eliminada exitosamente',
            'status' => 200
        ], 200);
    }
}
