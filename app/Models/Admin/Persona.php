<?php

namespace App\Models\Admin;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;

class Persona extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    // public $timestamps = false;
    public $table = 'weps_persona';
    protected $primaryKey = 'id_persona';



    protected $fillable = [
        'numero_documento',
        'nombre',
        'paterno',
        'materno',
        'genero',
        'fecha_nacimiento',
        'celular',
        'correo',
        'direccion',
        'lugar_nacimiento',
        // 'estado_persona',
        'apoderado',
        'foto',
        'id_tipo_persona_fk',

    ];

    static $rules = [
        'numero_documento' => 'required|unique:weps_persona,numero_documento',
        'nombre' => 'required|min:3|max:150',
        'paterno' => 'nullable|min:3|max:150|one_not_empty:materno',
        'materno' => 'nullable|min:3|max:150',
        'genero' => 'nullable|in:MASCULINO,FEMENINO',
        'fecha_nacimiento' => 'nullable|date',
        'celular' => 'nullable|max:12',
        'correo' => 'nullable|email|max:240',
        'direccion' => 'nullable|max:200',
        'lugar_nacimiento' => 'nullable|max:200',
        // 'estado_persona' => 'nullable',
        'apoderado' => 'nullable|max:250',
        // 'foto' => 'nullable|max:200',
        'id_tipo_persona_fk' => 'required|exists:weps_tipo_persona,id_tipo_persona',

    ];

    static $messages = [

        'one_not_empty' => 'Debe ingresar al menos un apellido.',

    ];


    static $customAttributes = [

        'numero_documento' => 'Numero de C.I.',
        'nombre' => 'Nombre',
        'paterno' => 'Apellido paterno',
        'materno' => 'Apellido materno',
        'genero' => 'Género',
        'fecha_nacimiento' => 'Fecha de nacimiento',
        'celular' => 'Numero de Celular',
        'correo' => 'Direccion de Correo ',
        'direccion' => 'Dirección de domicilio',
        'lugar_nacimiento' => 'Lugar de nacimiento',
        'estado_persona' => 'Estado de Inscripción',
        'apoderado' => 'Nombre completo delApoderado',
        // 'foto' => 'Foto',
        'id_tipo_persona_fk' => 'Tipo de persona',

    ];










    public static function listAll($filtros, $idPersona = null)
    {
        $search = $filtros['search'] ?? '';

        $search = convMayuscula(str_replace(' ', '%', $search));

        $tipoPersona = $filtros['tipo_persona'] ?? '';
        $estadoPersona = $filtros['estado_persona'] ?? '';


        $query = DB::table('weps_persona as p')
            ->selectRaw("id_persona, numero_documento, nombre, paterno, materno, genero, fecha_nacimiento,
            celular, correo, direccion, lugar_nacimiento, estado_persona, apoderado, foto, created_at, updated_at,id_tipo_persona_fk,tipo_persona")
            ->join('weps_tipo_persona as tp', 'tp.id_tipo_persona', '=', 'p.id_tipo_persona_fk')
            ->orderBy('p.id_persona', 'desc');


        if (!empty($idPersona)) {

            $query->where('id_persona', $idPersona);
        } else {
            if (!empty($search)) {
                $query->where(function ($query) use ($search) {
                    $query->whereRaw("concat(nombre,' ',COALESCE(paterno,''),' ',COALESCE(materno,''),' ',numero_documento) LIKE ?", ["%$search%"])
                        ->orWhereRaw("concat(COALESCE(paterno,''),' ',COALESCE(materno,''),' ',nombre,' ',numero_documento) LIKE ?", ["%$search%"])
                        ->orWhereRaw("concat(nombre,' ',COALESCE(materno,''),' ',COALESCE(paterno,''),' ',numero_documento) LIKE ?", ["%$search%"])
                        ->orWhereRaw("concat(numero_documento,' ',COALESCE(paterno,''),' ',nombre,' ',COALESCE(materno,'')) LIKE ?", ["%$search%"]);
                });
            }


            empty($tipoPersona) ?: $query->where('id_tipo_persona_fk', $tipoPersona);

            if ($estadoPersona != '') {

                $estadoPersona == 0 ?  $query->whereNull('estado_persona') : $query->where('estado_persona', $estadoPersona);
            }
        }

        return $query;
    }



    public static function storeImage($imgBase64, $type = "png")
    {

        $data = "";
        if (preg_match('/^data:image\/(\w+);base64,/', $imgBase64, $matches)) {
            $type = $matches[1]; // Sobrescribe $type con el tipo real de la imagen
            $data = substr($imgBase64, strpos($imgBase64, ',') + 1);
            $data = base64_decode($data);
            if ($data === false) {
                throw new \Exception('Ocurrió un error al decodificar la imagen');
            }
        } else {
            throw new \Exception('No se pudo encontrar el tipo de imagen');
        }

        $imageName = 'foto/' . Str::random(10) . uniqid() . '.' . $type;

        // verifyPath(storage_path('app/public/foto'));

        Storage::disk('public')->put($imageName, $data);

        if (Storage::disk('public')->exists($imageName)) {
            return $imageName;
        } else {
            return null;
        }
    }


    public static function search($filtros)
    {
        $search = $filtros['search'] ?? '';

        $search = convMayuscula(str_replace(' ', '%', $search));

        $tipoPersona = $filtros['tipo_persona'] ?? '';


        $query = DB::table('weps_persona as p')
            ->selectRaw("id_persona as id,concat(nombre,' ',COALESCE(paterno,''),' ',COALESCE(materno,''),', C.I.: ',COALESCE(numero_documento,''),', - ',COALESCE(tipo_persona,'')) as text")
            ->join('weps_tipo_persona as tp', 'tp.id_tipo_persona', '=', 'p.id_tipo_persona_fk')
            ->orderBy('p.id_persona', 'desc')
            ->limit(10);


        $query->where(function ($query) use ($search) {
            $query->whereRaw("concat(nombre,' ',COALESCE(paterno,''),' ',COALESCE(materno,''),' ',numero_documento) LIKE ?", ["%$search%"])
                ->orWhereRaw("concat(COALESCE(paterno,''),' ',COALESCE(materno,''),' ',nombre,' ',numero_documento) LIKE ?", ["%$search%"])
                ->orWhereRaw("concat(nombre,' ',COALESCE(materno,''),' ',COALESCE(paterno,''),' ',numero_documento) LIKE ?", ["%$search%"])
                ->orWhereRaw("concat(numero_documento,' ',COALESCE(paterno,''),' ',nombre,' ',COALESCE(materno,'')) LIKE ?", ["%$search%"]);
        });

        empty($tipoPersona) ?: $query->where('id_tipo_persona_fk', $tipoPersona);


        return $query;
    }


    public static function buscarEstudiante($filtros)
    {
        $search = $filtros['search'] ?? '';

        $search = convMayuscula(str_replace(' ', '%', $search));


        $query = DB::table('weps_persona as p')
            ->selectRaw("i.id_inscripcion as id,concat(numero,', ',nombre,' ',COALESCE(paterno,''),' ',COALESCE(materno,''),', C.I.: ',COALESCE(numero_documento,'')) as text, i.id_grupo_entrenamiento,p.foto")
            ->join('weps_inscripcion as i', 'i.id_persona', '=', 'p.id_persona')
            ->join('weps_grupo_entrenamiento as ge', 'ge.id_grupo_entrenamiento', '=', 'i.id_grupo_entrenamiento')
            ->join('weps_sucursal as s', 's.id_sucursal', '=', 'ge.id_sucursal_fk')
            ->orderBy('i.id_inscripcion', 'desc')
            // ->where('id_tipo_persona_fk','=', 1)
            ->where('i.estado_inscripcion', '!=', 'RETIRADO')
            ->limit(15);


        $query->where(function ($query) use ($search) {
            $query->whereRaw("concat(nombre,' ',COALESCE(paterno,''),' ',COALESCE(materno,''),' ',numero_documento) LIKE ?", ["%$search%"])
                ->orWhereRaw("concat(COALESCE(paterno,''),' ',COALESCE(materno,''),' ',nombre,' ',numero_documento) LIKE ?", ["%$search%"])
                ->orWhereRaw("concat(nombre,' ',COALESCE(materno,''),' ',COALESCE(paterno,''),' ',numero_documento) LIKE ?", ["%$search%"])
                ->orWhereRaw("concat(nombre,' ',COALESCE(materno,''),' ',COALESCE(paterno,''),' ',numero) LIKE ?", ["%$search%"])
                ->orWhereRaw("concat(numero,' ',COALESCE(paterno,''),' ',nombre,' ',COALESCE(materno,'')) LIKE ?", ["%$search%"])
                ->orWhereRaw("concat(numero_documento,' ',COALESCE(paterno,''),' ',nombre,' ',COALESCE(materno,'')) LIKE ?", ["%$search%"]);
        });

        return $query;
    }
}
