<?php

namespace App\Models\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;

class Valoracion extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'weps_valoracion';
    protected $primaryKey = 'id_valoracion';



    protected $fillable = [
        'id_inscripcion_fk',
        'numero_valoracion',
        'fecha_valoracion',
        'puesto',
        'dorsal',
        'altura',
        'peso',
        'pierna',
        'correlativo_valoracion',
    ];

    static $rules = [
        'id_inscripcion_fk' => 'required',
        // 'numero_valoracion' => 'required',
        'fecha_valoracion' => 'required|date',
        'puesto' => 'required',
        'dorsal' => 'required',
        'altura' => 'required',
        'peso' => 'required',
        'pierna' => 'required',
        // 'correlativo_valoracion' => 'required',
        'caracteristicas.*' => 'required',
        'valoracion.*' => 'nullable|array|min:1|max:100',

    ];




    public static function getCorrelativoValoracion($idInscripcion)
    {
        $correlativo = Valoracion::where('id_inscripcion_fk', $idInscripcion)->whereYear('fecha_valoracion', date('Y'))->max('correlativo_valoracion');
        return  empty($correlativo) ? 1 : ((int) $correlativo + 1);
    }

    public static function generarNumeroValoracion($correlativo, $fecha)
    {
        $anio = date('Y', strtotime($fecha));

        return $anio . '-' . $correlativo;
    }





    public static function getValoracion($idValoracion)
    {

        "SELECT
        id_valoracion_caracteristica,
        id_caracteristica_fk,
        id_valoracion_fk,
        observacion_valoracion,
        id_caracteristica,
        caracteristica,
        (
            SELECT
            JSON_ARRAYAGG(
                JSON_OBJECT(
                    'id_atributo_fk', id_atributo_fk,
                    'id_valoracion_atributo', id_valoracion_atributo,
                    'valor', valor
                ) order by id_atributo_fk asc
            )
            FROM weps_valoracion_atributo va
            WHERE va.id_caracteristica_fk = c.id_caracteristica AND va.id_valoracion_fk = vc.id_valoracion_fk
        ) as atributos
        FROM weps_valoracion_caracteristica vc
        RIGHT JOIN weps_caracteristica c ON vc.id_caracteristica_fk = c.id_caracteristica
        and vc.id_valoracion_fk = 2";



        $query = DB::table('weps_valoracion_caracteristica as vc')
            ->selectRaw(
                'vc.id_valoracion_caracteristica,
                vc.id_caracteristica_fk,
                vc.id_valoracion_fk,
                vc.observacion_valoracion,
                c.id_caracteristica,
                c.caracteristica'
            )
            ->selectRaw("(SELECT JSON_ARRAYAGG( JSON_OBJECT(
                    'id_atributo_fk', id_atributo_fk,
                    'id_valoracion_atributo', id_valoracion_atributo,
                    'valor', valor
                            ) order by id_atributo_fk asc
                        )
                        FROM weps_valoracion_atributo va
                        WHERE va.id_caracteristica_fk = c.id_caracteristica AND va.id_valoracion_fk = vc.id_valoracion_fk
                    ) as atributos")
            ->rightJoin('weps_caracteristica as c', 'vc.id_caracteristica_fk', '=', 'c.id_caracteristica')
            ->where('vc.id_valoracion_fk', $idValoracion)
            ->orderBy('vc.id_caracteristica_fk', 'asc');

        return $query;
    }


    public static function getCaracteristicasAtributo()
    {

        "SELECT
            id_caracteristica,
            caracteristica,
            (
                SELECT
                JSON_ARRAYAGG(
                    JSON_OBJECT(
                        'id_atributo', id_atributo,
                        'nombre_atributo', nombre_atributo
                    ) order by id_atributo asc
                )
                FROM weps_atributo a
                WHERE a.id_caracteristica_fk = c.id_caracteristica
            ) as atributos
            FROM weps_caracteristica c";

        $query = DB::table('weps_caracteristica as c')
            ->selectRaw(
                'c.id_caracteristica,
                    c.caracteristica'
            )
            ->selectRaw("(SELECT JSON_ARRAYAGG( JSON_OBJECT(
                        'id_atributo', id_atributo,
                        'nombre_atributo', nombre_atributo
                                ) order by id_atributo asc
                            )
                            FROM weps_atributo a
                            WHERE a.id_caracteristica_fk = c.id_caracteristica
                        ) as atributos")
            ->orderBy('c.id_caracteristica', 'asc');

        return $query;
    }


    public static function listAll($filtros, $idInscripcion = null)
    {
        $search = $filtros['search'] ?? '';

        $search = convMayuscula(str_replace(' ', '%', $search));

        $tipoPersona = $filtros['tipo_persona'] ?? '';
        $estadoPersona = $filtros['estado_inscripcion'] ?? '';

        $fieldsAdd = ", correo, direccion, lugar_nacimiento, estado_persona, apoderado,  i.created_at, i.updated_at,id_tipo_persona_fk,tipo_persona";


        $query = DB::table('weps_inscripcion as i')
            ->selectRaw("id_inscripcion,  i.id_grupo_entrenamiento, tipo_inscripcion, fecha_inicio, i.fecha_fin, fecha_registro, i.descripcion,
                i.observacion, estado_inscripcion, monto_inscripcion, codigo, numero, correlativo_gestion, i.id_sucursal_fk, turno,dia,
                p.id_persona,numero_documento, nombre, paterno,materno, genero,fecha_nacimiento,foto,celular,
                nombre_grupo, nombre_categoria, nombre_sucursal,gestion" . (!empty($idInscripcion) ? $fieldsAdd : ''))
            ->selectRaw(" (SELECT
                        json_arrayagg(
                            json_object(
                                'id_valoracion', id_valoracion,
                                'numero_valoracion', numero_valoracion,
                                'fecha_valoracion', fecha_valoracion
                            ) order by fecha_valoracion DESC  limit 5
                        )
                        FROM weps_valoracion
                        WHERE id_inscripcion_fk = i.id_inscripcion
                    ) as valoraciones")
            ->selectRaw("( SELECT count(id_valoracion)
                            FROM weps_valoracion
                            WHERE id_inscripcion_fk = i.id_inscripcion
                        ) as cantidad_valoraciones")
            ->join('weps_persona as p', 'p.id_persona', '=', 'i.id_persona')
            ->join('weps_grupo_entrenamiento as ge', 'ge.id_grupo_entrenamiento', '=', 'i.id_grupo_entrenamiento')
            ->join('weps_sucursal as s', 's.id_sucursal', '=', 'i.id_sucursal_fk')
            ->join('weps_categoria as c', 'c.id_categoria', '=', 'ge.id_categoria')
            ->join('weps_gestion as g', 'g.id_gestion', '=', 'ge.id_gestion')
            ->join('weps_tipo_persona as tp', 'tp.id_tipo_persona', '=', 'p.id_tipo_persona_fk')
            ->orderBy('i.id_inscripcion', 'desc')
            ->orderBy('ge.id_grupo_entrenamiento', 'desc');



        if (!empty($idInscripcion)) {

            $query->where('id_inscripcion', $idInscripcion);
        } else {
            if (!empty($search)) {
                $query->where(function ($query) use ($search) {
                    $query->whereRaw("concat(nombre,' ',COALESCE(paterno,''),' ',COALESCE(materno,''),' ',numero_documento) LIKE ?", ["%$search%"])
                        ->orWhereRaw("concat(COALESCE(paterno,''),' ',COALESCE(materno,''),' ',nombre,' ',numero_documento) LIKE ?", ["%$search%"])
                        ->orWhereRaw("concat(nombre,' ',COALESCE(materno,''),' ',COALESCE(paterno,''),' ',numero_documento) LIKE ?", ["%$search%"])
                        ->orWhereRaw("concat(nombre,' ',COALESCE(materno,''),' ',COALESCE(paterno,''),' ',numero) LIKE ?", ["%$search%"])
                        ->orWhereRaw("concat(numero_documento,' ',COALESCE(paterno,''),' ',nombre,' ',COALESCE(materno,'')) LIKE ?", ["%$search%"]);
                });
            }


            empty($tipoPersona) ?: $query->where('id_tipo_persona_fk', $tipoPersona);

            if ($estadoPersona != '') {

                $estadoPersona == 0 ?  $query->whereNull('estado_inscripcion') : $query->where('estado_inscripcion', $estadoPersona);
            }
        }

        return $query;
    }

}
