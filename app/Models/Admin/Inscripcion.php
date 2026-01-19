<?php

namespace App\Models\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;

class Inscripcion extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'weps_inscripcion';
    protected $primaryKey = 'id_inscripcion';


    protected $fillable = [
        'id_persona',
        'id_grupo_entrenamiento',
        'tipo_inscripcion',
        'fecha_inicio',
        'fecha_fin',
        'fecha_registro',
        'descripcion',
        'observacion',
        'estado_inscripcion',
        'monto_inscripcion',
        'codigo',
        'numero',
        'correlativo_gestion',
        'id_sucursal_fk'
    ];

    public static $rules = [
        'id_persona' => 'required|integer|exists:weps_persona,id_persona',
        'id_grupo_entrenamiento' => 'required|integer|exists:weps_grupo_entrenamiento,id_grupo_entrenamiento',
        'tipo_inscripcion' => 'required',
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'nullable|date',
        'descripcion' => 'nullable|string|max:250',
        'observacion' => 'nullable|string|max:250',
        'estado_inscripcion' => 'required',
        'monto_inscripcion' => 'required|numeric|min:0|max:2000',
        'id_sucursal_fk' => 'required|integer|exists:weps_sucursal,id_sucursal'
    ];

    static $messages = [
        'id_persona.required' => 'El campo :attribute es obligatorio.',
        'id_persona.integer' => 'El campo :attribute debe ser un número entero.',
        'id_persona.exists' => 'El campo :attribute no existe en la tabla persona.',
        'id_grupo_entrenamiento.required' => 'El campo :attribute es obligatorio.',
        'id_grupo_entrenamiento.integer' => 'El campo :attribute debe ser un número entero.',
        'id_grupo_entrenamiento.exists' => 'El campo :attribute no existe en la tabla grupo entrenamiento.',
        'tipo_inscripcion.required' => 'El campo :attribute es obligatorio.',
        'fecha_inicio.required' => 'El campo :attribute es obligatorio.',
        'fecha_inicio.date' => 'El campo :attribute debe ser una fecha válida.',
        'fecha_fin.date' => 'El campo :attribute debe ser una fecha válida.',
        'descripcion.string' => 'El campo :attribute debe ser una cadena de texto.',
        'descripcion.max' => 'El campo :attribute debe tener máximo 250 caracteres.',
        'observacion.string' => 'El campo :attribute debe ser una cadena de texto.',
        'observacion.max' => 'El campo :attribute debe tener máximo 250 caracteres.',
        'estado_inscripcion.required' => 'El campo :attribute es obligatorio.',
        'monto_inscripcion.required' => 'El campo :attribute es obligatorio.',
        'monto_inscripcion.numeric' => 'El campo :attribute debe ser un número.',
        'monto_inscripcion.min' => 'El campo :attribute debe ser mayor o igual a 0.',
        'monto_inscripcion.max' => 'El campo :attribute debe ser menor o igual a 2000.',
        'id_sucursal_fk.required' => 'El campo :attribute es obligatorio.',
        'id_sucursal_fk.integer' => 'El campo :attribute debe ser un número entero.',
        'id_sucursal_fk.exists' => 'El campo :attribute no existe en la tabla sucursal.'
    ];

    static $customAttributes = [
        'id_persona' => 'persona',
        'id_grupo_entrenamiento' => 'grupo de entrenamiento',
        'tipo_inscripcion' => 'tipo de inscripción',
        'fecha_inicio' => 'fecha de inicio',
        'fecha_fin' => 'fecha de fin',
        'fecha_registro' => 'fecha de registro',
        'descripcion' => 'descripción',
        'observacion' => 'observación',
        'estado_inscripcion' => 'estado de inscripción',
        'monto_inscripcion' => 'monto de inscripción',
        'codigo' => 'código',
        'numero' => 'número',
        'correlativo_gestion' => 'correlativo de gestión',
        'id_sucursal_fk' => 'sucursal'
    ];



    public function grupoEntrenamiento()
    {
        return $this->belongsTo(GrupoEntrenamiento::class, 'id_grupo_entrenamiento', 'id_grupo_entrenamiento');
    }



    public static function getCorrelativo()
    {
        $correlativo = Inscripcion::whereYear('fecha_registro', date('Y'))->max('correlativo_gestion');
        return  empty($correlativo) ? 1 : ((int) $correlativo + 1);
    }

    public static function generarNumero($correlativo)
    {
        $numero = completarCeros($correlativo, 4) . '-' . date('Y');
        return $numero;
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


    public static function getPagosInscripcion($condicion)
    {
        "SELECT
        gestion,
        mes,
        monto,
        saldo,
        pmg.observacion,
        estado_pago
        FROM
        weps_inscripcion i
        INNER JOIN weps_pago_mes_gestion pmg ON pmg.id_inscripcion = i.id_inscripcion
        INNER JOIN weps_gestion g ON g.id_gestion = pmg.id_gestion
        WHERE i.codigo = '63fd1a884ea2c'
        ORDER BY pmg.id_pago_mes_gestion ASC";


        $query = DB::table('weps_inscripcion as i')
            ->selectRaw("id_pago_mes_gestion, gestion, mes, monto, saldo, pmg.observacion_pago,estado_pago,fecha_pago")
            ->join('weps_pago_mes_gestion as pmg', 'pmg.id_inscripcion', '=', 'i.id_inscripcion')
            ->join('weps_gestion as g', 'g.id_gestion', '=', 'pmg.id_gestion')
            ->join('weps_mes as m', 'm.id_mes', '=', 'pmg.id_mes_fk')
            ->where($condicion)
            ->orderBy('pmg.id_pago_mes_gestion', 'desc')
            ->orderBy('pmg.id_mes_fk', 'desc')
            ->orderBy('pmg.fecha_pago', 'desc');

        return $query;
    }


    public static function getInscripcionCodigo($codigo)
    {


        $query = DB::table('weps_inscripcion as i')
            ->selectRaw("id_inscripcion,  i.id_grupo_entrenamiento, tipo_inscripcion, fecha_inicio, i.fecha_fin, fecha_registro, i.descripcion,
                i.observacion, estado_inscripcion, monto_inscripcion, codigo, numero, correlativo_gestion, i.id_sucursal_fk, turno,dia,dia_extra,
                p.id_persona,numero_documento, nombre, paterno,materno, genero,fecha_nacimiento,foto,celular,
                nombre_grupo, nombre_categoria, nombre_sucursal,gestion , correo, direccion, lugar_nacimiento, estado_persona, apoderado,  i.created_at, i.updated_at,id_tipo_persona_fk,tipo_persona")
            ->join('weps_persona as p', 'p.id_persona', '=', 'i.id_persona')
            ->join('weps_grupo_entrenamiento as ge', 'ge.id_grupo_entrenamiento', '=', 'i.id_grupo_entrenamiento')
            ->join('weps_sucursal as s', 's.id_sucursal', '=', 'i.id_sucursal_fk')
            ->join('weps_categoria as c', 'c.id_categoria', '=', 'ge.id_categoria')
            ->join('weps_gestion as g', 'g.id_gestion', '=', 'ge.id_gestion')
            ->join('weps_tipo_persona as tp', 'tp.id_tipo_persona', '=', 'p.id_tipo_persona_fk')
            ->orderBy('i.id_inscripcion', 'desc')
            ->orderBy('ge.id_grupo_entrenamiento', 'desc');

        $query->where('codigo', $codigo);

        return $query;
    }

    public static function getInscritosSucursal()
    {

        "
        SELECT
            id_sucursal,
            nombre_sucursal,
            COUNT(*) as total_inscripciones
        FROM weps_inscripcion as i
        JOIN weps_sucursal as s ON s.id_sucursal = i.id_sucursal_fk
        WHERE i.estado_inscripcion IN('INSCRITO', 'PENDIENTE')
        GROUP BY i.id_sucursal_fk
        ";

        $query = DB::table('weps_inscripcion as i')
            ->selectRaw("id_sucursal, nombre_sucursal, COUNT(*) as total_inscripciones")
            ->join('weps_sucursal as s', 's.id_sucursal', '=', 'i.id_sucursal_fk')
            ->whereIn('i.estado_inscripcion', ["INSCRITO", "PENDIENTE"])
            ->groupBy('id_sucursal')
            ->groupBy('nombre_sucursal');

        return $query;

    }


    public static function getAsistenciasGrupo($idGrupoEntrenamiento, $mes, $anio)
    {
        return Inscripcion::join('weps_persona as p', 'p.id_persona', '=', 'weps_inscripcion.id_persona')
        ->leftJoin('weps_asistencia as a', function ($join) use ($mes, $anio) {
            $join->on('a.id_inscripcion_fk', '=', 'weps_inscripcion.id_inscripcion')
                ->whereRaw('MONTH(a.fecha_asistencia) = ?', [$mes])
                ->whereRaw('YEAR(a.fecha_asistencia) = ?', [$anio]);
        })
        ->select(
            'weps_inscripcion.id_grupo_entrenamiento',
            'weps_inscripcion.id_persona',
            'weps_inscripcion.id_inscripcion',
            'p.nombre',
            'p.paterno',
            'p.materno',
            'estado_inscripcion',
        )
        // Agrupar en un objeto de array las asistencias en orden ascendente por fecha
        ->selectRaw('
                JSON_ARRAYAGG(
                    JSON_OBJECT(
                        "id_asistencia", a.id_asistencia,
                        "fecha_asistencia", a.fecha_asistencia,
                        "ingreso", a.ingreso,
                        "salida", a.salida,
                        "estado_asistencia", a.estado_asistencia,
                        "permiso", a.permiso
                    )
                ) as asistencias
            ')
        ->groupBy([
            'weps_inscripcion.id_grupo_entrenamiento',
            'weps_inscripcion.id_persona',
            'weps_inscripcion.id_inscripcion',
            'p.nombre',
            'p.paterno',
            'p.materno',
            'estado_inscripcion'
        ])
        ->where('weps_inscripcion.id_grupo_entrenamiento', $idGrupoEntrenamiento)
        ->orderBy('a.fecha_asistencia', 'asc')
        ->orderBy('p.nombre', 'asc')
        ->get();


    }
}
