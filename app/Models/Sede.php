<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_sede';
    public $incrementing = true;
    // protected $keyType = 'bigInteger';

    protected $fillable = ['nombre_sede', 'ubicacion'];

    public function sede()
    {
        return $this->hasMany(Grupo::class, 'id_sede', 'id_sede');
    }
}
