<?php

namespace App\Models\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;

class GrupoEntrenamiento extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;


    protected $table = 'weps_grupo_entrenamiento';
    protected $primaryKey = 'id_grupo_entrenamiento';


    // id_categoria
    // id_gestion
    // id_entrenador
    // nombre_grupo
    // descripcion_grupo
    // fecha_creacion
    // fecha_fin
    // dia
    // hora_inicio
    // hora_fin
    // dia_extra
    // hora_inicio_dia_extra
    // estado_grupo
    // turno
    // id_sucursal_fk


    protected $fillable = [
        'id_categoria',
        'id_gestion',
        'id_entrenador',
        'nombre_grupo',
        'descripcion_grupo',
        'fecha_creacion',
        'fecha_fin',
        'dia',
        'hora_inicio',
        'hora_fin',
        'dia_extra',
        'hora_inicio_dia_extra',
        'estado_grupo',
        'turno',
        'id_sucursal_fk',
    ];

    static $rules = [
        'id_categoria' => 'required|exists:weps_categoria,id_categoria',
        'id_gestion' => 'required|exists:weps_gestion,id_gestion',
        'id_entrenador' => 'nullable|exists:weps_persona,id_persona',
        'nombre_grupo' => 'required|min:3|max:240',
        'descripcion_grupo' => 'nullable|max:1000',
        'fecha_creacion' => 'required|date',
        'fecha_fin' => 'nullable|date',
        'dias' => 'nullable',
        'hora_inicio' => 'nullable|date_format:H:i',
        'hora_fin' => 'nullable|date_format:H:i',
        'dia_extra' => 'nullable',
        'hora_inicio_dia_extra' => 'nullable|date_format:H:i',
        'estado_grupo' => 'nullable|in:ACTIVO,INACTIVO',
        'turno' => 'nullable|in:MAÑANA,TARDE',
        'id_sucursal_fk' => 'nullable|exists:weps_sucursal,id_sucursal',
    ];





    public function entrenador()
    {
        return $this->belongsTo(Persona::class, 'id_entrenador', 'id_persona');
    }


    public static function getParam()
    {
        return DB::table('weps_grupo_entrenamiento as ge')
            ->selectRaw('ge.id_grupo_entrenamiento, ge.nombre_grupo,nombre_categoria,gestion,turno, dia,precio, nombre_sucursal,id_sucursal_fk')
            ->join('weps_sucursal as s', 's.id_sucursal', '=', 'ge.id_sucursal_fk')
            ->join('weps_categoria as c', 'c.id_categoria', '=', 'ge.id_categoria')
            ->join('weps_gestion as g', 'g.id_gestion', '=', 'ge.id_gestion')
            ->where('ge.estado_grupo', 'ACTIVO');
    }


    public static function getAllGrupos($filtros, $idGrupoEntrenamiento = null)
    {

        $search = $filtros['search'] ?? '';

        $sucursal= $filtros['id_sucursal'] ?? '';
        $categoria= $filtros['id_categoria'] ?? '';



        $query = DB::table('weps_grupo_entrenamiento as ge')
            ->selectRaw('ge.*,c.nombre_categoria, gestion, nombre,paterno,materno, nombre_sucursal');

        if (empty($idGrupoEntrenamiento) == false) {
            $query->selectRaw("(
                SELECT JSON_ARRAYAGG(
                    id_dia_fk
                )
                FROM weps_dia_grupo_entrenamiento as dge
                WHERE dge.id_grupo_entrenamiento_fk = ge.id_grupo_entrenamiento AND dge.es_dia_extra = 0
            ) as dias_entrenamiento");
            $query->selectRaw("(
                SELECT JSON_ARRAYAGG(
                   id_dia_fk
                )
                FROM weps_dia_grupo_entrenamiento as dge
                WHERE dge.id_grupo_entrenamiento_fk = ge.id_grupo_entrenamiento AND dge.es_dia_extra = 1
            ) as dias_extra_entrenamiento");

            $query->where('ge.id_grupo_entrenamiento', $idGrupoEntrenamiento);
        }else{

            if (!empty($search)) {
                $query->where(function ($query) use ($search) {
                    $query->where('ge.nombre_grupo', 'like', '%' . $search . '%')
                        ->orWhere('c.nombre_categoria', 'like', '%' . $search . '%')
                        ->orWhere('gestion', 'like', '%' . $search . '%')
                        ->orWhere('nombre', 'like', '%' . $search . '%')
                        ->orWhere('paterno', 'like', '%' . $search . '%')
                        ->orWhere('materno', 'like', '%' . $search . '%')
                        ->orWhere('nombre_sucursal', 'like', '%' . $search . '%');
                });
            }

            empty($sucursal) ?: $query->where('ge.id_sucursal_fk', $sucursal);
            empty($categoria) ?: $query->where('ge.id_categoria', $categoria);

        }

        $query->leftJoin('weps_sucursal as s', 's.id_sucursal', '=', 'ge.id_sucursal_fk')
            ->join('weps_categoria as c', 'c.id_categoria', '=', 'ge.id_categoria')
            ->join('weps_gestion as g', 'g.id_gestion', '=', 'ge.id_gestion')
            ->leftJoin('weps_persona as p', 'p.id_persona', '=', 'ge.id_entrenador')
            ->orderBy('ge.id_grupo_entrenamiento', 'desc');

        return $query;
    }



    public static function getGrupoEntrenamiento($idGrupoEntrenamiento)
    {
        return GrupoEntrenamiento::join('weps_categoria as c', 'c.id_categoria', 'weps_grupo_entrenamiento.id_categoria')
            ->join('weps_persona  as p', 'p.id_persona', 'weps_grupo_entrenamiento.id_entrenador')
            ->join('weps_sucursal as s', 's.id_sucursal', 'weps_grupo_entrenamiento.id_sucursal_fk')
            ->select('weps_grupo_entrenamiento.*', 'c.nombre_categoria', 'p.nombre', 'p.paterno','p.materno', 's.nombre_sucursal')
            ->orderBy('id_grupo_entrenamiento', 'desc')
            ->where('id_grupo_entrenamiento', $idGrupoEntrenamiento)
            ->get();
    }


    public static function getDiasEntrenamiento($idGrupoEntrenamiento)
    {

        return DB::table('weps_dia_grupo_entrenamiento as dge')
            ->selectRaw('dge.*, dge.id_dia_fk, dge.es_dia_extra, d.nombre_dia,d.dia_semanal')
            ->join('weps_dia as d', 'd.id_dia', '=', 'dge.id_dia_fk')
            ->where('dge.id_grupo_entrenamiento_fk', $idGrupoEntrenamiento)
            ->orderBy('dge.id_dia_fk', 'asc')
            ->get();
    }

}
