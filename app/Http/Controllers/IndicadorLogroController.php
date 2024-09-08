<?php

namespace App\Http\Controllers;

use App\Models\IndicadorLogro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndicadorLogroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Incluye la relación con la unidad didáctica
        $indicadores = IndicadorLogro::with('unidadDidactica')->get();
        return response()->json($indicadores, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación
        $validator = Validator::make($request->all(), [
            'descripcion' => 'required|string|max:255',
            'id_unidad_didactica' => 'required|exists:unidades_didacticas,id_unidad_didactica',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400,
            ], 400);
        }

        // Crear el indicador de logro
        $indicador = IndicadorLogro::create($request->all());

        return response()->json([
            'message' => 'Indicador de logro creado exitosamente',
            'indicador' => $indicador,
            'status' => 201,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Incluye la relación con la unidad didáctica
        $indicador = IndicadorLogro::with('unidadDidactica')->find($id);

        if (!$indicador) {
            return response()->json([
                'message' => 'Indicador de logro no encontrado',
                'status' => 404,
            ], 404);
        }

        return response()->json($indicador, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $indicador = IndicadorLogro::find($id);

        if (!$indicador) {
            return response()->json([
                'message' => 'Indicador de logro no encontrado',
                'status' => 404,
            ], 404);
        }

        // Validación
        $validator = Validator::make($request->all(), [
            'descripcion' => 'string|max:255',
            'id_unidad_didactica' => 'exists:unidades_didacticas,id_unidad_didactica',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400,
            ], 400);
        }

        // Actualizar el indicador de logro
        $indicador->update($request->all());

        return response()->json([
            'message' => 'Indicador de logro actualizado exitosamente',
            'indicador' => $indicador,
            'status' => 200,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $indicador = IndicadorLogro::find($id);

        if (!$indicador) {
            return response()->json([
                'message' => 'Indicador de logro no encontrado',
                'status' => 404,
            ], 404);
        }

        // Eliminar el indicador de logro
        $indicador->delete();

        return response()->json([
            'message' => 'Indicador de logro eliminado exitosamente',
            'status' => 200,
        ], 200);
    }
}
