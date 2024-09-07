<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $table = 'grupos';

    protected $fillable = [
        'nombre_grupo',
        'id_sede',
        'id_turno',
        'id_especialidad',
        'id_plan',
        'id_docente',
    ];

    public function sede()
    {
        return $this->belongsTo(Sede::class, 'id_sede', 'id_sede');
    }

    public function turno()
    {
        return $this->belongsTo(Turno::class, 'id_turno', 'id');
    }

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'id_especialidad', 'id_especialidad');
    }

    public function plan()
    {
        return $this->belongsTo(Planes::class, 'id_plan', 'id_plan');
    }

    public function docente()
    {
        return $this->belongsTo(Usuario::class, 'id_docente', 'id_usuario');
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class, 'id_grupo', 'id_grupo');
    }
}
