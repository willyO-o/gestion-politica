<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PagoMesGestion extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;


    protected $table = 'weps_pago_mes_gestion';
    protected $primaryKey = 'id_pago_mes_gestion';

    protected $fillable = [
        'id_inscripcion',
        'id_gestion',
        'monto',
        'saldo',
        'fecha_pago',
        'estado_pago',
        'observacion_pago',
        'id_mes_fk',
    ];

    public static $rules = [
        'id_inscripcion' => 'required|integer|exists:weps_inscripcion,id_inscripcion',
        'id_gestion' => 'required|integer|exists:weps_gestion,id_gestion|unique_relationship:weps_pago_mes_gestion,id_mes_fk,id_inscripcion',
        'monto' => 'required|numeric|min:0|max:2000',
        'saldo' => 'nullable|numeric|min:0|max:2000',
        'fecha_pago' => 'required|date',
        'estado_pago' => 'required|in:PENDIENTE,COMPLETADO',
        'observacion_pago' => 'nullable|string|max:250',
        'id_mes_fk' => 'required|integer|exists:weps_mes,id_mes'
    ];

    static $customAttributes = [
        'id_inscripcion' => 'inscripción',
        'id_gestion' => 'gestión',
        'monto' => 'monto',
        'saldo' => 'saldo',
        'fecha_pago' => 'fecha de pago',
        'estado_pago' => 'estado del pago',
        'observacion_pago' => 'observación del pago',
        'id_mes_fk' => 'mes del pago'
    ];

    static $messages = [
        'id_inscripcion.required' => 'No se selecciono una Inscripcion.',
        'id_inscripcion.integer' => 'La Inscripcion seleccionada no es valida.',
        'unique_relationship' => 'Ya existe un pago Registrado para la gestión y Mes seleccionados, si desea puede editar el registro para completar el pago ',

    ];



}
