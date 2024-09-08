<?php

namespace App\Http\Controllers;

use App\Models\UnidadDidactica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UnidadDidacticaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Incluye la relación con el programa asociado
        $unidades = UnidadDidactica::with('programa')->get();
        return response()->json($unidades, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación
        $validator = Validator::make($request->all(), [
            'nombre_unidad' => 'required|string|max:255',
            'id_programa' => 'required|exists:programas,id_programa',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400,
            ], 400);
        }

        // Crear la unidad didáctica
        $unidad = UnidadDidactica::create($request->all());

        return response()->json([
            'message' => 'Unidad didáctica creada exitosamente',
            'unidad' => $unidad,
            'status' => 201,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Incluye la relación con el programa asociado
        $unidad = UnidadDidactica::with('programa')->find($id);

        if (!$unidad) {
            return response()->json([
                'message' => 'Unidad didáctica no encontrada',
                'status' => 404,
            ], 404);
        }

        return response()->json($unidad, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $unidad = UnidadDidactica::find($id);

        if (!$unidad) {
            return response()->json([
                'message' => 'Unidad didáctica no encontrada',
                'status' => 404,
            ], 404);
        }

        // Validación
        $validator = Validator::make($request->all(), [
            'nombre_unidad' => 'string|max:255',
            'id_programa' => 'exists:programas,id_programa',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400,
            ], 400);
        }

        // Actualizar la unidad didáctica
        $unidad->update($request->all());

        return response()->json([
            'message' => 'Unidad didáctica actualizada exitosamente',
            'unidad' => $unidad,
            'status' => 200,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $unidad = UnidadDidactica::find($id);

        if (!$unidad) {
            return response()->json([
                'message' => 'Unidad didáctica no encontrada',
                'status' => 404,
            ], 404);
        }

        // Eliminar la unidad didáctica
        $unidad->delete();

        return response()->json([
            'message' => 'Unidad didáctica eliminada exitosamente',
            'status' => 200,
        ], 200);
    }
}
