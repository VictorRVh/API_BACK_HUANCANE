<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;

    protected $table = 'especialidades';
    protected $primaryKey = 'id_especialidad';

    protected $fillable = [
        'nombre_especialidad',
    ];

    public function planes()
    {
        return $this->hasMany(Planes::class, 'id_especialidad', 'id_especialidad');
    }

    public function grupos()
    {
        return $this->hasMany(Grupo::class, 'id_especialidad', 'id_especialidad');
    }

}
