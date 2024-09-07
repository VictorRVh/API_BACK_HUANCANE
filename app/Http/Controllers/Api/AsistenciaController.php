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
    public function index() {

        $asistencia = Asistencia::all();
        return response()->json($asistencia);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'fecha' => 'required|date',
            'estado' => 'required|string|max:255',
            'id_unidad_didactica' => 'required|exists:unidades_didacticas,id_unidad_didactica',
            'id_estudiante' => 'required|exists:usuarios,id_usuario',
            'id_docente' => 'required|exists:usuarios,id_usuario',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        // Crear la nueva asistencia
        $asistencia = Asistencia::create([
            'fecha' => $request->fecha,
            'estado' => $request->estado,
            'id_unidad_didactica' => $request->id_unidad_didactica,
            'id_estudiante' => $request->id_estudiante,
            'id_docente' => $request->id_docente,
        ]);

        if (!$asistencia) {
            $data = [
                'message' => 'Error al crear la asistencia',
                'status' => 500
            ];

            return response()->json($data, 500);
        }

        $data = [
            'asistencia' => $asistencia,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Asistencia $asistencia)
    {
        return response()->json($asistencia);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'fecha' => 'required|date',
            'estado' => 'required|string|max:255',
            'id_unidad_didactica' => 'required|exists:unidades_didacticas,id_unidad_didactica',
            'id_estudiante' => 'required|exists:usuarios,id_usuario',
            'id_docente' => 'required|exists:usuarios,id_usuario',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        // Encontrar el registro existente
        $asistencia = Asistencia::find($id);

        if (!$asistencia) {
            $data = [
                'message' => 'Asistencia no encontrada',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        $asistencia->fecha = $request->fecha;
        $asistencia->estado = $request->estado;
        $asistencia->id_unidad_didactica = $request->id_unidad_didactica;
        $asistencia->id_estudiante = $request->id_estudiante;
        $asistencia->id_docente = $request->id_docente;
        $asistencia->save();

        $data = [
            'asistencia' => $asistencia,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asistencia $asistencia)
    {
        //
    }
}
