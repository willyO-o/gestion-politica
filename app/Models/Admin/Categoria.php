<?php

namespace App\Models\Admin;

use DateTimeInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use OwenIt\Auditing\Contracts\Auditable;

class Categoria extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;




    protected $table = 'weps_categoria';
    protected $primaryKey = 'id_categoria';



    protected $fillable = [

        'nombre_categoria',
        'descripcion',
        'precio',
        'estado'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    static $rules = [
        'nombre_categoria' => 'required|max:255|min:5|unique:weps_categoria,nombre_categoria',
        'descripcion' => 'nullable',
        'precio' => 'nullable|numeric|max:300',
        'estado' => 'nullable'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public static function getAllCategoria($filtros)
    {

        $search = $filtros['search'] ?? null;

        $query = DB::table('weps_categoria')
            ->selectRaw('*')
            ->orderBy('id_categoria', 'desc');

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('nombre_categoria', 'like', '%' . $search . '%');
            });
        }

        return $query;
    }
}
