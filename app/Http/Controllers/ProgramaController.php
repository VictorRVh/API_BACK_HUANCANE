<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProgramaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Incluye la relación con el plan asociado
        $programas = Programa::with('plan')->get();
        return response()->json($programas, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación
        $validator = Validator::make($request->all(), [
            'nombre_programa' => 'required|string|max:255',
            'id_plan' => 'required|exists:planes,id_plan',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400,
            ], 400);
        }

        // Crear el programa
        $programa = Programa::create($request->all());

        return response()->json([
            'message' => 'Programa creado exitosamente',
            'programa' => $programa,
            'status' => 201,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Incluye la relación con el plan asociado
        $programa = Programa::with('plan')->find($id);

        if (!$programa) {
            return response()->json([
                'message' => 'Programa no encontrado',
                'status' => 404,
            ], 404);
        }

        return response()->json($programa, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $programa = Programa::find($id);

        if (!$programa) {
            return response()->json([
                'message' => 'Programa no encontrado',
                'status' => 404,
            ], 404);
        }

        // Validación
        $validator = Validator::make($request->all(), [
            'nombre_programa' => 'string|max:255',
            'id_plan' => 'exists:planes,id_plan',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400,
            ], 400);
        }

        // Actualizar el programa
        $programa->update($request->all());

        return response()->json([
            'message' => 'Programa actualizado exitosamente',
            'programa' => $programa,
            'status' => 200,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $programa = Programa::find($id);

        if (!$programa) {
            return response()->json([
                'message' => 'Programa no encontrado',
                'status' => 404,
            ], 404);
        }

        // Eliminar el programa
        $programa->delete();

        return response()->json([
            'message' => 'Programa eliminado exitosamente',
            'status' => 200,
        ], 200);
    }
}
