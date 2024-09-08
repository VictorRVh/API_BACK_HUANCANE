<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = "roles";

    protected $primaryKey = 'id_rol';
    // public $incrementing = true;
    // protected $keyType = 'bigInteger';

    protected $fillable = ['rol'];

    public function rolPermiso()
    {
        return $this->hasMany(RolPermiso::class, 'id_rol', 'id_rol');
    }

    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'id_rol', 'id_rol');
    }
}
