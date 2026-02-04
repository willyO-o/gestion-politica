<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Actividad extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'weps_actividad';
    protected $fillable = [
        'nombre_actividad',
        'fecha_actividad',
        'descripcion',
    ];

    // protected $casts = [
    //     'fecha_actividad' => 'date',
    // ];

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'id_actividad_fk', 'id');
    }


    static $rules = [
        'nombre_actividad' => 'required|string|max:100',
        'fecha_actividad' => 'required|date',
        'descripcion' => 'nullable|string|max:5000',
    ];

    static $messages = [
        'nombre_actividad.required' => 'El nombre de la actividad es obligatorio',
        'nombre_actividad.string' => 'El nombre de la actividad debe ser una cadena de texto',
        'nombre_actividad.max' => 'El nombre de la actividad no debe superar los 100 caracteres',
        'fecha_actividad.required' => 'La fecha de la actividad es obligatoria',
        'fecha_actividad.date' => 'La fecha de la actividad debe ser una fecha válida',
        'descripcion.string' => 'La descripción debe ser una cadena de texto',
        'descripcion.max' => 'La descripción no debe superar los 5000 caracteres',
    ];

}
