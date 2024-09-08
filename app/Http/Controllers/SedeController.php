<?php

namespace App\Http\Controllers;

use App\Models\Sede;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class SedeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sedes = Sede::all();

        return response()->json([
            'message' => 'Lista de sedes',
            'sedes' => $sedes,
            'status' => 200
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'nombre_sede' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        // Crear la sede
        $sede = Sede::create($request->all());

        return response()->json([
            'message' => 'Sede creada exitosamente',
            'sede' => $sede,
            'status' => 201
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id_sede)
    {
        $sede = Sede::find($id_sede);

        if (!$sede) {
            return response()->json([
                'message' => 'Sede no encontrada',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'message' => 'Detalles de la sede',
            'sede' => $sede,
            'status' => 200
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_sede)
    {
        $sede = Sede::find($id_sede);

        if (!$sede) {
            return response()->json([
                'message' => 'Sede no encontrada',
                'status' => 404
            ], 404);
        }

        // Validación de datos
        $validator = Validator::make($request->all(), [
            'nombre_sede' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        // Actualizar la sede
        $sede->update($request->all());

        return response()->json([
            'message' => 'Sede actualizada exitosamente',
            'sede' => $sede,
            'status' => 200
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_sede)
    {
        $sede = Sede::find($id_sede);

        if (!$sede) {
            return response()->json([
                'message' => 'Sede no encontrada',
                'status' => 404
            ], 404);
        }

        // Eliminar la sede
        $sede->delete();

        return response()->json([
            'message' => 'Sede eliminada exitosamente',
            'status' => 200
        ], 200);
    }
}
