namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_sede';
    public $incrementing = true;
    protected $keyType = 'bigInteger';

    protected $fillable = ['nombre_sede', 'ubicacion'];
}
