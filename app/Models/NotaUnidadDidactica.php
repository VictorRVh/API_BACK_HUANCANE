<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaUnidadDidactica extends Model
{
    use HasFactory;

    protected $table = 'notas_unidades_didacticas';

    protected $fillable = [
        'nota',
        'id_unidad_didactica',
        'id_estudiante',
        'id_docente',
    ];

    public function unidadDidactica()
    {
        return $this->belongsTo(UnidadDidactica::class, 'id_unidad_didactica', 'id_unidad_didactica');
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
