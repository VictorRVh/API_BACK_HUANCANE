<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    // public $incrementing = true;
    // protected $keyType = 'bigInteger';

    protected $fillable = ['nombre_turno'];

    public function grupos()
    {
        return $this->hasMany(Grupo::class, 'id_turno', 'id');
    }
}
