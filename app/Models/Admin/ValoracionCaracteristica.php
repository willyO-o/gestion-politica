<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \OwenIt\Auditing\Auditable;

class ValoracionCaracteristica extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'weps_valoracion_caracteristica';

    protected $primaryKey = 'id_valoracion_caracteristica';

    public $timestamps = false;

    protected $fillable = [
        'id_caracteristica_fk',
        'id_valoracion_fk',
        'observacion_valoracion',
    ];





}
