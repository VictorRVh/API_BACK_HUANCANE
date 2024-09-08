<?php

namespace App\Http\Controllers;

use App\Models\Planes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $planes = Planes::with('especialidad')->get(); // Incluye la relación con especialidad
        return response()->json($planes, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación
        $validator = Validator::make($request->all(), [
            'nombre_plan' => 'required|string|max:255',
            'id_especialidad' => 'required|exists:especialidades,id_especialidad',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400,
            ], 400);
        }

        // Crear el plan
        $plan = Planes::create($request->all());

        return response()->json([
            'message' => 'Plan creado exitosamente',
            'plan' => $plan,
            'status' => 201,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $plan = Planes::with('especialidad')->find($id); // Incluye la relación con especialidad

        if (!$plan) {
            return response()->json([
                'message' => 'Plan no encontrado',
                'status' => 404,
            ], 404);
        }

        return response()->json($plan, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $plan = Planes::find($id);

        if (!$plan) {
            return response()->json([
                'message' => 'Plan no encontrado',
                'status' => 404,
            ], 404);
        }

        // Validación
        $validator = Validator::make($request->all(), [
            'nombre_plan' => 'string|max:255',
            'id_especialidad' => 'exists:especialidades,id_especialidad',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400,
            ], 400);
        }

        // Actualizar el plan
        $plan->update($request->all());

        return response()->json([
            'message' => 'Plan actualizado exitosamente',
            'plan' => $plan,
            'status' => 200,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $plan = Planes::find($id);

        if (!$plan) {
            return response()->json([
                'message' => 'Plan no encontrado',
                'status' => 404,
            ], 404);
        }

        // Eliminar el plan
        $plan->delete();

        return response()->json([
            'message' => 'Plan eliminado exitosamente',
            'status' => 200,
        ], 200);
    }
}
