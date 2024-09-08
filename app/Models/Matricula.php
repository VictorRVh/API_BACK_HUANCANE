<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    protected $table = 'matriculas';
    protected $primaryKey = 'id_matricula';

    protected $fillable = [
        'id_grupo',
        'id_estudiante',
    ];

    public function grupos()
    {
        return $this->belongsTo(Grupo::class, 'id_grupo', 'id_grupo');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_estudiante', 'id_usuario');
    }
}
