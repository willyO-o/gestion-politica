<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Rol;
use App\Models\Admin\Persona;
use App\Models\Admin\Sucursal;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Laravolt\Avatar\Facade as Avatar;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements Auditable
{
    use HasApiTokens, HasFactory, Notifiable;
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    //nombre de tabla
    protected $table = 'weps_users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'usuario',
        'email',
        'password',
        'estado_usuario',
        'id_persona_fk',
        'us_avatar',
        'id_rol_fk',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];



    public static function rules($update = false)
    {
        $rules = [
            'usuario' => 'required|string|max:50|unique:weps_users,usuario',
            'password' => 'required|string|max:255',
            'confirm_password' => 'required|string|max:255|same:password',
            'id_persona_fk' => 'required|integer|exists:weps_persona,id_persona',
            'id_rol_fk' => 'required|integer|exists:weps_rol,id_rol',
            'susursales_autorizadas.*' => 'required|integer|exists:weps_sucursal,id_sucursal',
        ];

        if ($update) {
            unset($rules['usuario'], $rules['id_persona_fk']);
        }



        return $rules;
    }





    public function persona()
    {

        return $this->belongsTo(Persona::class, 'id_persona_fk', 'id_persona');
    }

    public static  function getRol($idRol)
    {
        return Rol::find($idRol);
    }


    public function sucursales()
    {
        return $this->belongsToMany(Sucursal::class, 'weps_usuario_sucursal', 'id_user_fk', 'id_sucursal_fk')->withTimestamps()->withPivot('estado_sucursal_usuario');
    }


    public static function getUsers($filtros, $idUsuario = null)
    {

        $search = $filtros['search'] ?? '';

        $query =  DB::table('weps_users as u')
            ->selectRaw('u.id,usuario,u.created_at,estado_usuario,us_avatar,id_persona_fk ,id_rol_fk, nombre, paterno, materno, numero_documento, rol')
            ->selectRaw('(
                SELECT JSON_ARRAYAGG(
                        JSON_OBJECT(
                            "id_sucursal", id_sucursal,
                             "nombre_sucursal", nombre_sucursal
                        )
                    )
                FROM weps_usuario_sucursal as us
                JOIN weps_sucursal as s ON s.id_sucursal = us.id_sucursal_fk
                WHERE us.id_user_fk = u.id
            ) as sucursales_autorizadas')
            ->join('weps_persona as p', 'p.id_persona', '=', 'u.id_persona_fk')
            ->join('weps_rol as r', 'r.id_rol', '=', 'u.id_rol_fk')
            ->orderBy('u.id', 'desc');

        if (empty($idUsuario)) {
            if (!empty($search)) {
                $query->where('nombre', 'like', '%' . $search . '%')
                    ->orWhere('paterno', 'like', '%' . $search . '%')
                    ->orWhere('materno', 'like', '%' . $search . '%')
                    ->orWhere('numero_documento', 'like', '%' . $search . '%')
                    ->orWhere('rol', 'like', '%' . $search . '%');
            }
        } else {
            $query->where('u.id', $idUsuario);
        }


        return $query;
    }

    public static function getRoles()
    {
        return DB::table('weps_rol')->select('id_rol', 'rol')->get();
    }

    public static function getPersonas()
    {
        $query =  DB::table('weps_persona as p')
            ->selectRaw('p.id_persona, nombre, paterno, materno, numero_documento, tipo_persona')
            ->join('weps_tipo_persona as tp', 'tp.id_tipo_persona', '=', 'p.id_tipo_persona_fk')
            ->whereRaw('p.id_tipo_persona_fk != 1')
            ->where('p.estado_persona', "ACTIVO")
            ->orderBy('p.id_persona', 'desc');


        return $query;
    }


    public static function createAvatar($persona, $usuario)
    {
        $rutaUserAvatar = storage_path('app/public/user/avatar/');
        $nombreCompletoUsuario = convMayuscula($persona->nombre . ' ' . $persona->paterno . ' ' . $persona->materno);
        $nombreArchivo = $usuario . ".png";

        verifyPath($rutaUserAvatar);

        $avatar = Avatar::create($nombreCompletoUsuario)->setFontSize(100)->setDimension(200, 200)->setShape('square')->setBorder(0, '#498dca')->setBackground('#498dca')->setForeground('#ffffff');

        $avatar->save($rutaUserAvatar . $nombreArchivo);

        if (file_exists($rutaUserAvatar . $nombreArchivo) == false) {
            return false;
        }

        return $nombreArchivo;
    }



    public static function verifyUserSucursal($idUser, $sucursales)
    {
        $sucursalesUsuario = DB::table('weps_usuario_sucursal')->where('id_user_fk', $idUser)->whereIn('id_sucursal_fk', $sucursales)->count();

        return ($sucursalesUsuario == count($sucursales));
    }

    public static function verifyUserAvatar($persona, $usuario)
    {
        $rutaUserAvatar = storage_path('app/public/user/avatar/');
        $nombreArchivo = $usuario . ".png";

        if (file_exists($rutaUserAvatar . $nombreArchivo) == false) {
            return self::createAvatar($persona, $usuario);
        }

        return $nombreArchivo;
    }
}
