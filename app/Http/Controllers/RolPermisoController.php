<?php

namespace App\Http\Controllers;

use App\Models\RolPermiso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RolPermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Obtener todos los registros de rol_permiso
    public function index()
    {
        $rolPermisos = RolPermiso::with(['rol', 'permiso'])->get();
        return response()->json($rolPermisos);
    }

    // Crear un nuevo registro en rol_permiso
    public function store(Request $request)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'id_rol' => 'required|exists:roles,id_rol',
            'id_permiso' => 'required|exists:permisos,id_permiso',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        // Crear un nuevo rol_permiso
        $rolPermiso = RolPermiso::create([
            'id_rol' => $request->id_rol,
            'id_permiso' => $request->id_permiso,
        ]);

        return response()->json([
            'rol_permiso' => $rolPermiso,
            'status' => 201
        ], 201);
    }

    // Mostrar un registro específico de rol_permiso
    public function show($id)
    {
        $rolPermiso = RolPermiso::with(['rol', 'permiso'])->find($id);

        if (!$rolPermiso) {
            return response()->json([
                'message' => 'RolPermiso no encontrado',
                'status' => 404
            ], 404);
        }

        return response()->json($rolPermiso);
    }

    // Actualizar un registro existente de rol_permiso
    public function update(Request $request, $id)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'id_rol' => 'required|exists:roles,id_rol',
            'id_permiso' => 'required|exists:permisos,id_permiso',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        // Encontrar el registro existente
        $rolPermiso = RolPermiso::find($id);

        if (!$rolPermiso) {
            return response()->json([
                'message' => 'RolPermiso no encontrado',
                'status' => 404
            ], 404);
        }

        // Actualizar el registro
        $rolPermiso->id_rol = $request->id_rol;
        $rolPermiso->id_permiso = $request->id_permiso;
        $rolPermiso->save();

        return response()->json([
            'rol_permiso' => $rolPermiso,
            'status' => 200
        ], 200);
    }

    // Eliminar un registro de rol_permiso
    public function destroy($id)
    {
        // Encontrar el registro existente
        $rolPermiso = RolPermiso::find($id);

        if (!$rolPermiso) {
            return response()->json([
                'message' => 'RolPermiso no encontrado',
                'status' => 404
            ], 404);
        }

        // Eliminar el registro
        $rolPermiso->delete();

        return response()->json([
            'message' => 'RolPermiso eliminado exitosamente',
            'status' => 200
        ], 200);
    }
}
