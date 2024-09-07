<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grupo = Grupo::all();
        return response()->json($grupo);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'nombre_grupo' => 'required|string|max:255',
            'id_sede' => 'required|exists:sedes,id_sede',
            'id_turno' => 'required|exists:turnos,id',
            'id_especialidad' => 'required|exists:especialidades,id_especialidad',
            'id_plan' => 'required|exists:planes,id_plan',
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

        // Crear el nuevo grupo
        $grupo = Grupo::create([
            'nombre_grupo' => $request->nombre_grupo,
            'id_sede' => $request->id_sede,
            'id_turno' => $request->id_turno,
            'id_especialidad' => $request->id_especialidad,
            'id_plan' => $request->id_plan,
            'id_docente' => $request->id_docente,
        ]);

        if (!$grupo) {
            $data = [
                'message' => 'Error al crear el grupo',
                'status' => 500
            ];

            return response()->json($data, 500);
        }

        $data = [
            'grupo' => $grupo,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Grupo $grupo)
    {
        return response()->json($grupo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'nombre_grupo' => 'required|string|max:255',
            'id_sede' => 'required|exists:sedes,id_sede',
            'id_turno' => 'required|exists:turnos,id',
            'id_especialidad' => 'required|exists:especialidades,id_especialidad',
            'id_plan' => 'required|exists:planes,id_plan',
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

        // Buscar el grupo por ID
        $grupo = Grupo::find($id);

        if (!$grupo) {
            $data = [
                'message' => 'Grupo no encontrado',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        // Actualizar los datos del grupo
        $grupo->nombre_grupo = $request->nombre_grupo;
        $grupo->id_sede = $request->id_sede;
        $grupo->id_turno = $request->id_turno;
        $grupo->id_especialidad = $request->id_especialidad;
        $grupo->id_plan = $request->id_plan;
        $grupo->id_docente = $request->id_docente;

        if (!$grupo->save()) {
            $data = [
                'message' => 'Error al actualizar el grupo',
                'status' => 500
            ];

            return response()->json($data, 500);
        }

        $data = [
            'grupo' => $grupo,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grupo $grupo)
    {
        //
    }
}
