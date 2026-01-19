<?php

namespace App\Models\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;

class Asistencia extends Model  implements Auditable
{
    use HasFactory;

    use \OwenIt\Auditing\Auditable;

    protected $table = 'weps_asistencia';
    protected $primaryKey = 'id_asistencia';


    protected $fillable = [
        'id_inscripcion_fk',
        'observacion',
        'ingreso',
        'salida',
        'fecha_asistencia',
        'estado_asistencia',
        'permiso',
    ];


    static $rules = [
        'id_inscripcion_fk' => 'required|exists:weps_inscripcion,id_inscripcion',
        'observacion' => 'nullable|max:2000',
        'ingreso' => 'nullable|date_format:H:i|required_without:permiso',
        'salida' => 'nullable|date_format:H:i|required_without:permiso',
        'fecha_asistencia' => 'required|date|dia_correspondiente|unique_asistencia',
        'permiso' => 'nullable',
    ];

    static $messages = [
        'id_inscripcion_fk.required' => 'Por favor seleccione una inscripción de Estudiante',
        'id_inscripcion_fk.exists' => 'La inscripción no existe',
        'observacion.max' => 'La observación no debe superar los 2000 caracteres',
        'ingreso.date_format' => 'El campo ingreso debe ser una hora válida',
        'ingreso.required_without' => 'El campo ingreso es obligatorio si no se ha marcado permiso',
        'salida.date_format' => 'El campo salida debe ser una hora válida',
        'salida.required_without' => 'El campo salida es obligatorio si no se ha marcado permiso',
        'fecha_asistencia.required' => 'El campo fecha asistencia es obligatorio',
        'fecha_asistencia.date' => 'El campo fecha asistencia debe ser una fecha válida',
        'fecha_asistencia.dia_correspondiente' => 'La fecha de asistencia no corresponde a ninguno de los días de entrenamiento del grupo de entrenamiento del estudiante, selecione una fecha que corresponda a los dias: :dias',
        'fecha_asistencia.unique_asistencia' => 'Ya existe una asistencia o permiso registrada para esta fecha',
    ];



    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if ($model->permiso == 0) {
                $model->ingreso = date('Y-m-d H:i:s', strtotime($model->ingreso));
                $model->salida = $model->salida ? date('Y-m-d H:i:s', strtotime($model->salida)) : null;
            } else {
                $model->ingreso = null;
                $model->salida = null;
            }
        });

        static::updating(function ($model) {

            if ($model->permiso == 0) {
                $model->ingreso = date('Y-m-d H:i:s', strtotime($model->ingreso));
                $model->salida = $model->salida ? date('Y-m-d H:i:s', strtotime($model->salida)) : null;
            } else {
                $model->ingreso = null;
                $model->salida = null;
            }
        });
    }

    public static function getAsistenciaActualInscripcion($idInscripcion)
    {

        $query = DB::table('weps_asistencia')
            ->where('id_inscripcion_fk', $idInscripcion)
            ->where('fecha_asistencia', date('Y-m-d'));


        return $query;
    }


    public static function getListaAsistencias($filtros)
    {
        $query = DB::table('weps_asistencia as a')
            ->selectRaw('a.*,p.nombre,p.paterno,p.materno,p.numero_documento,p.foto,i.numero, g.nombre_grupo, s.nombre_sucursal,g.id_grupo_entrenamiento')
            ->join('weps_inscripcion as i', 'a.id_inscripcion_fk', '=', 'i.id_inscripcion')
            ->join('weps_persona as p', 'i.id_persona', '=', 'p.id_persona')
            ->join('weps_grupo_entrenamiento as g', 'i.id_grupo_entrenamiento', '=', 'g.id_grupo_entrenamiento')
            ->join('weps_sucursal as s', 'g.id_sucursal_fk', '=', 's.id_sucursal')
            ->orderBy('a.id_asistencia', 'desc')
            ->orderBy('a.fecha_asistencia', 'desc');

        if (empty($filtros['search']) == false) {

            $search = $filtros['search'] ?? '';

            $search = convMayuscula(str_replace(' ', '%', $search));

            $query->where(function ($query) use ($search) {
                $query->orWhereRaw("concat(nombre,' ',COALESCE(materno,''),' ',COALESCE(paterno,''),' ',numero_documento) LIKE ?", ["%$search%"])
                    ->orWhereRaw("concat(paterno,' ',COALESCE(materno,''),' ',COALESCE(nombre,''),' ',numero_documento) LIKE ?", ["%$search%"])
                    ->orWhereRaw("concat(materno,' ',COALESCE(paterno,''),' ',COALESCE(nombre,''),' ',numero_documento) LIKE ?", ["%$search%"])
                    ->orWhere('p.numero_documento', 'like', '%' . $search . '%')
                    ->orWhere('i.numero', 'like', '%' . $search . '%');
            });
        }

        if (empty($filtros['fecha_inicio']) == false) {
            $query->whereBetween('a.fecha_asistencia', [$filtros['fecha_inicio'], $filtros['fecha_fin']]);
        }


        // imprimir la consulta final generada
        // var_dump($query->toSql(),);

        return $query;
    }


    public static function getAsistenciaMensual($idInscripcion)
    {

        $query = DB::table('weps_asistencia as a')
            ->selectRaw('YEAR(a.fecha_asistencia) as anio, MONTH(a.fecha_asistencia) as mes')
            ->selectRaw('JSON_ARRAYAGG(JSON_OBJECT("id_asistencia", a.id_asistencia, "fecha_asistencia", a.fecha_asistencia, "ingreso", a.ingreso, "salida", a.salida, "permiso", a.permiso)) as asistencias')
            ->where('id_inscripcion_fk', $idInscripcion)
            ->groupBy('mes', 'anio')
            ->orderBy('anio', 'desc')
            ->orderBy('mes', 'desc');

        return $query;
    }
}
