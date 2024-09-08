<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;

    protected $table = 'permisos';
    protected $primaryKey = 'id_permiso';
    protected $fillable = ['nombre_permiso'];

    public function roles()
    {
        return $this->hasMany(RolPermiso::class, 'id_permiso', 'id_permiso');
    }
}
