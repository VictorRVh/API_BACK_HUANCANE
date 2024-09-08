<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asistencias = Asistencia::with(['unidadDidactica', 'estudiante', 'docente'])->get();
        return response()->json($asistencias, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los datos
        $validator = Validator::make($request->all(), [
            'fecha' => 'required|date',
            'estado' => 'required|string|max:255',
            'id_unidad_didactica' => 'required|exists:unidades_didacticas,id_unidad_didactica',
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

        // Crear y guardar la asistencia
        $asistencia = Asistencia::create($request->all());
        return response()->json($asistencia, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $asistencia = Asistencia::with(['unidadDidactica', 'estudiante', 'docente'])->find($id);
        if (!$asistencia) {
            return response()->json(['message' => 'Asistencia no encontrada'], 404);
        }
        return response()->json($asistencia, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validación de los datos
        $validator = Validator::make($request->all(), [
            'fecha' => 'required|date',
            'estado' => 'required|string|max:255',
            'id_unidad_didactica' => 'required|exists:unidades_didacticas,id_unidad_didactica',
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

        // Encontrar y actualizar la asistencia
        $asistencia = Asistencia::find($id);
        if (!$asistencia) {
            return response()->json(['message' => 'Asistencia no encontrada'], 404);
        }

        $asistencia->update($request->all());
        return response()->json($asistencia, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $asistencia = Asistencia::find($id);
        if (!$asistencia) {
            return response()->json(['message' => 'Asistencia no encontrada'], 404);
        }

        $asistencia->delete();
        return response()->json(['message' => 'Asistencia eliminada correctamente'], 200);
    }
}
