<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Inscripcion;
use App\Models\Admin\Asistencia;
use App\Models\Admin\GrupoEntrenamiento;
use Illuminate\Support\Facades\DB;

class PaginaWebController extends Controller
{
    public function index()
    {

        // return redirect()->route('login');
        // $sucursales = DB::table('weps_sucursal')->get();

        // $entrenadores = DB::table('weps_persona')->where('id_tipo_persona_fk', 2)->where('estado_persona', "ACTIVO")->get();


        // return view('public.index')->with('sucursales', $sucursales)->with('entrenadores', $entrenadores);
        return view('public.index');
    }

    public function velzon(string $file = 'index')
    {
        return view('velzon.' . $file);
    }

    public function horarios()
    {
        return view('public.horarios');
    }

    public function quienesSomos()
    {
        return view('public.quienes-somos');
    }

    public function contacto()
    {
        return view('public.contacto');
    }

    public function reglamento()
    {
        return view('public.reglamento');
    }

    public function inscripciones()
    {
        return view('public.inscripciones');
    }

    public function galeria()
    {

        return view('public.galeria');
    }

    public function sucursales()
    {
        $sucursales = DB::table('weps_sucursal')->where('central', 0)->where('estado_sucursal', "ACTIVO")->get();
        $central = DB::table('weps_sucursal')->where('central', 1)->first();
        return view('public.sucursales')->with('sucursales', $sucursales)->with('central', $central);
    }


    public function detalleInscripcion($codigo)
    {

        $inscripcion = Inscripcion::getInscripcionCodigo($codigo)->first();

        if (empty($inscripcion->id_inscripcion)) {
            abort(404);
        }

        $condicion["i.id_inscripcion"] = $inscripcion->id_inscripcion;
        $pagos = Inscripcion::getPagosInscripcion($condicion)->get();

        // dd($pagos);

        return view('public.detalle-inscripcion')
            ->with('pagos', $pagos)
            ->with('inscripcion', $inscripcion);
    }

    public function asistenciasInscripcion(Request $request)
    {

        $idInscripcion =  $request->input('idInscripcion');
        $idGrupoEntrenamiento =  $request->input('idGrupoEntrenamiento');

        $diasEntrenamiento = GrupoEntrenamiento::getDiasEntrenamiento($idGrupoEntrenamiento);
        $asistenciaMensual = Asistencia::getAsistenciaMensual($idInscripcion)->get();

        return response()->json([
            'success' => true,
            'data' => [
                "asistencia" => $asistenciaMensual,
                'diasEntrenamiento' => $diasEntrenamiento
            ]
        ]);
    }
}
