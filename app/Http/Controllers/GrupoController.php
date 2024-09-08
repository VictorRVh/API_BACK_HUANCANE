<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Incluye las relaciones asociadas
        $grupos = Grupo::with(['sede', 'turno', 'especialidad', 'plan', 'docente'])->get();
        return response()->json($grupos, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación
        $validator = Validator::make($request->all(), [
            'nombre_grupo' => 'required|string|max:255',
            'id_sede' => 'required|exists:sedes,id_sede',
            'id_turno' => 'required|exists:turnos,id',
            'id_especialidad' => 'required|exists:especialidades,id_especialidad',
            'id_plan' => 'required|exists:planes,id_plan',
            'id_docente' => 'required|exists:usuarios,id_usuario',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400,
            ], 400);
        }

        // Crear el grupo
        $grupo = Grupo::create($request->all());

        return response()->json([
            'message' => 'Grupo creado exitosamente',
            'grupo' => $grupo,
            'status' => 201,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Incluye las relaciones asociadas
        $grupo = Grupo::with(['sede', 'turno', 'especialidad', 'plan', 'docente'])->find($id);

        if (!$grupo) {
            return response()->json([
                'message' => 'Grupo no encontrado',
                'status' => 404,
            ], 404);
        }

        return response()->json($grupo, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $grupo = Grupo::find($id);

        if (!$grupo) {
            return response()->json([
                'message' => 'Grupo no encontrado',
                'status' => 404,
            ], 404);
        }

        // Validación
        $validator = Validator::make($request->all(), [
            'nombre_grupo' => 'string|max:255',
            'id_sede' => 'exists:sedes,id_sede',
            'id_turno' => 'exists:turnos,id',
            'id_especialidad' => 'exists:especialidades,id_especialidad',
            'id_plan' => 'exists:planes,id_plan',
            'id_docente' => 'exists:usuarios,id_usuario',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400,
            ], 400);
        }

        // Actualizar el grupo
        $grupo->update($request->all());

        return response()->json([
            'message' => 'Grupo actualizado exitosamente',
            'grupo' => $grupo,
            'status' => 200,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $grupo = Grupo::find($id);

        if (!$grupo) {
            return response()->json([
                'message' => 'Grupo no encontrado',
                'status' => 404,
            ], 404);
        }

        // Eliminar el grupo
        $grupo->delete();

        return response()->json([
            'message' => 'Grupo eliminado exitosamente',
            'status' => 200,
        ], 200);
    }
}
