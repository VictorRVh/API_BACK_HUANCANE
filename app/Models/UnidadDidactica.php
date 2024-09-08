<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadDidactica extends Model
{
    use HasFactory;

    protected $table = 'unidades_didacticas';
    protected $primaryKey = 'id_unidad_didactica';
    // public $incrementing = true;
    // protected $keyType = 'bigInteger';

    protected $fillable = ['nombre_unidad', 'id_programa'];

    public function programa()
    {
        return $this->belongsTo(Programa::class, 'id_programa');
    }

    public function asistencia()
    {
        return $this->hasMany(Asistencia::class, 'id_unidad_didactica', 'id_unidad_didactica');
    }

    public function notasUnidadDidactica()
    {
        return $this->hasMany(NotaUnidadDidactica::class, 'id_unidad_didactica', 'id_unidad_didactica');
    }
}
