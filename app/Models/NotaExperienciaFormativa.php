<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaExperienciaFormativa extends Model
{
    use HasFactory;

    protected $table = 'notas_experiencias_formativas';

    protected $primaryKey = 'id_nota';

    protected $fillable = [
        'nota',
        'id_experiencia',
        'id_estudiante',
        'id_docente',
    ];


    public function experienciaFormativa()
    {
        return $this->belongsTo(ExperienciaFormativa::class, 'id_experiencia', 'id_experiencia');
    }

    public function estudiante()
    {
        return $this->belongsTo(Usuario::class, 'id_estudiante', 'id_usuario');
    }

    public function docente()
    {
        return $this->belongsTo(Usuario::class, 'id_docente', 'id_usuario');
    }
}
