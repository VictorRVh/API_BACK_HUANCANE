<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadDidactica extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_unidad_didactica';
    public $incrementing = true;
    protected $keyType = 'bigInteger';

    protected $fillable = ['nombre_unidad', 'id_programa'];

    public function programa()
    {
        return $this->belongsTo(Programa::class, 'id_programa');
    }
}
