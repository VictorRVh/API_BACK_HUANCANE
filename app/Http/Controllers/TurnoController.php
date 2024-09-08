<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TurnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $turnos = Turno::all();
        return response()->json($turnos, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_turno' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400,
            ], 400);
        }

        $turno = Turno::create($request->all());

        return response()->json([
            'message' => 'Turno creado exitosamente',
            'turno' => $turno,
            'status' => 201,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $turno = Turno::find($id);

        if (!$turno) {
            return response()->json([
                'message' => 'Turno no encontrado',
                'status' => 404,
            ], 404);
        }

        return response()->json($turno, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $turno = Turno::find($id);

        if (!$turno) {
            return response()->json([
                'message' => 'Turno no encontrado',
                'status' => 404,
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre_turno' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400,
            ], 400);
        }

        $turno->update($request->all());

        return response()->json([
            'message' => 'Turno actualizado exitosamente',
            'turno' => $turno,
            'status' => 200,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $turno = Turno::find($id);

        if (!$turno) {
            return response()->json([
                'message' => 'Turno no encontrado',
                'status' => 404,
            ], 404);
        }

        $turno->delete();

        return response()->json([
            'message' => 'Turno eliminado exitosamente',
            'status' => 200,
        ], 200);
    }
}
