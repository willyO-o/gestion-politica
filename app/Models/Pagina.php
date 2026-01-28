<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagina extends Model
{
    use HasFactory;

    protected $table = 'weps_pagina';

    protected $fillable = [
        'titulo',
        'enlace',
        'compartidas',
        'me_gusta',
        'id_bloque',
        'id_persona',
    ];

    public function bloque()
    {
        return $this->belongsTo(GrupoEntrenamiento::class, 'id_bloque', 'id_grupo_entrenamiento');
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona', 'id_persona');
    }
}
