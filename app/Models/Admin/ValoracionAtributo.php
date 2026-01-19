<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ValoracionAtributo extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'weps_valoracion_atributo';

    protected $primaryKey = 'id_valoracion_atributo';

    public $timestamps = false;

    protected $fillable = [
        'id_caracteristica_fk',
        'id_atributo_fk',
        'id_valoracion_fk',
        'valor',
    ];

}
