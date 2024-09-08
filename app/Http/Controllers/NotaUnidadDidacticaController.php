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
        $notas = NotaUnidadDidactica::with(['unidadDidactica', 'estudiante', 'docente'])->get();
        return response()->json($notas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'nota' => 'required|integer',
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

        // Crear una nueva nota
        $nota = NotaUnidadDidactica::create([
            'nota' => $request->nota,
            'id_unidad_didactica' => $request->id_unidad_didactica,
            'id_estudiante' => $request->id_estudiante,
            'id_docente' => $request->id_docente,
        ]);

        return response()->json([
            'nota' => $nota,
            'status' => 201
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $nota = NotaUnidadDidactica::with(['unidadDidactica', 'estudiante', 'docente'])->find($id);

        if (!$nota) {
            return response()->json([
                'message' => 'Nota no encontrada',
                'status' => 404
            ], 404);
        }

        return response()->json($nota);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nota' => 'required|integer',
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

        $notaUnidadDidactica = NotaUnidadDidactica::find($id);

        if (!$notaUnidadDidactica) {
            return response()->json([
                'message' => 'NotaUnidadDidactica no encontrada',
                'status' => 404
            ], 404);
        }

        $notaUnidadDidactica->nota = $request->nota;
        $notaUnidadDidactica->id_unidad_didactica = $request->id_unidad_didactica;
        $notaUnidadDidactica->id_estudiante = $request->id_estudiante;
        $notaUnidadDidactica->id_docente = $request->id_docente;
        $notaUnidadDidactica->save();

        return response()->json([
            'nota_unidad_didactica' => $notaUnidadDidactica,
            'status' => 200
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Encontrar el registro existente
        $nota = NotaUnidadDidactica::find($id);

        if (!$nota) {
            return response()->json([
                'message' => 'Nota no encontrada',
                'status' => 404
            ], 404);
        }

        // Eliminar el registro
        $nota->delete();

        return response()->json([
            'message' => 'Nota eliminada exitosamente',
            'status' => 200
        ], 200);
    }
}
