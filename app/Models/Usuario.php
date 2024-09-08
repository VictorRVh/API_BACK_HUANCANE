<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    protected $fillable = ['nombre', 'apellido', 'dni', 'email', 'telefono', 'direccion', 'contrasena', 'id_rol'];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol', 'id_rol');
    }

    public function matricula()
    {
        return $this->hasMany(Matricula::class, 'id_estudiante', 'id_usuario');
    }
}
