<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndicadorLogro extends Model
{
    use HasFactory;

    protected $table = 'indicadores_logro'; // Nombre de la tabla en la base de datos

    protected $primaryKey = 'id_indicador'; // Clave primaria de la tabla

    public $timestamps = true; // Habilitar los timestamps (created_at y updated_at)

    protected $fillable = [
        'descripcion',
        'id_unidad_didactica'
    ]; // Los atributos que se pueden asignar masivamente
    
    // Definir la relación con la unidad didáctica
    public function unidadDidactica()
    {
        return $this->belongsTo(UnidadDidactica::class, 'id_unidad_didactica');
    }
}
