<?php

namespace App\Models\Admin;

use DateTimeInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;


class Sucursal extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;


    protected $table = 'weps_sucursal';
    protected $primaryKey = 'id_sucursal';



    protected $fillable = [

        'nombre_sucursal',
        'direccion_sucursal',
        'telefono',
        'estado_sucursal',
        'latitud',
        'logitud'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    static $rules = [
        'nombre_sucursal' => 'required|max:255|min:5|unique:weps_sucursal,nombre_sucursal',
        'direccion_sucursal' => 'nullable',
        'telefono' => 'nullable|numeric|digits_between:7,10',
        'estado_sucursal' => 'nullable',
        'latitud' => 'nullable',
        'logitud' => 'nullable'
    ];


    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public static function getAllSucursal($filtros)
    {

        $search = $filtros['search'] ?? null;

        $query = DB::table('weps_sucursal')
            ->selectRaw('*')
            ->orderBy('id_sucursal', 'desc');

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('nombre_sucursal', 'like', '%' . $search . '%');
            });
        }


        return $query;
    }
}
