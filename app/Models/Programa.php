<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    use HasFactory;

    protected $table = 'programas';
    protected $primaryKey = 'id_programa';
    protected $fillable = ['nombre_programa', 'id_plan'];

    public function plan()
    {
        return $this->belongsTo(Planes::class, 'id_plan');
    }

    public function unidadesDidacticas()
    {
        return $this->hasMany(UnidadDidactica::class, 'id_programa');
    }
}
