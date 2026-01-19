<?php

namespace App\Http\Controllers;

use App\Models\Admin\Inscripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = DB::table('weps_users')->count();
        $sucursales = DB::table('weps_sucursal')->count();
        $inscritos = DB::table('weps_inscripcion')->whereIn('estado_inscripcion', ['INSCRITO', 'PENDIENTE'])->count();
        $entrenadores = DB::table('weps_persona')->where('id_tipo_persona_fk', 2)->count();


        return view('admin.inicio')
            ->with('users', $users)
            ->with('sucursales', $sucursales)
            ->with('inscritos', $inscritos)
            ->with('entrenadores', $entrenadores);
    }


    public function getInicio()
    {
        $inscritos = Inscripcion::getInscritosSucursal()->get();

        return response()->json([
            'success' => true,
            'data' => [
                'inscritos' => $inscritos
            ]
        ]);
    }
}
