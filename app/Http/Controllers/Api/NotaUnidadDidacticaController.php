<?php

namespace App\Http\Controllers;

use App\Models\NotaUnidadDidactica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotaUnidadDidacticaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notas = NotaUnidadDidactica::all();
        return response()->json($notas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'id_unidad_didactica' => 'required|exists:unidades_didacticas,id_unidad_didactica',
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

        // Crear la nueva nota de unidad didáctica
        $nota = NotaUnidadDidactica::create([
            'id_unidad_didactica' => $request->id_unidad_didactica,
            'id_estudiante' => $request->id_estudiante,
            'id_docente' => $request->id_docente,
            'nota' => $request->nota,
        ]);

        if (!$nota) {
            $data = [
                'message' => 'Error al crear la nota de unidad didáctica',
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
    public function show(NotaUnidadDidactica $notaUnidadDidactica)
    {
        return response()->json($notaUnidadDidactica);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'id_unidad_didactica' => 'required|exists:unidades_didacticas,id_unidad_didactica',
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

        // Buscar la nota de unidad didáctica por ID
        $nota = NotaUnidadDidactica::find($id);

        if (!$nota) {
            $data = [
                'message' => 'Nota de unidad didáctica no encontrada',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        // Actualizar los datos de la nota
        $nota->id_unidad_didactica = $request->id_unidad_didactica;
        $nota->id_estudiante = $request->id_estudiante;
        $nota->id_docente = $request->id_docente;
        $nota->nota = $request->nota;

        if (!$nota->save()) {
            $data = [
                'message' => 'Error al actualizar la nota de unidad didáctica',
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
    public function destroy(NotaUnidadDidactica $notaUnidadDidactica)
    {
        $notaUnidadDidactica->delete();
        return response()->json(null, 204);
    }
}
