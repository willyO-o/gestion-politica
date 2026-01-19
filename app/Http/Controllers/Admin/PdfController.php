<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Lib\reportesrt\Reportes;
use App\Models\Admin\Valoracion;
use App\Models\Admin\Inscripcion;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Admin\GrupoEntrenamiento;

class PdfController extends Controller
{
    protected $reportes;


    protected $meses = [
        "1" => 'Enero',
        "2" => 'Febrero',
        "3" => 'Marzo',
        "4" => 'Abril',
        "5" => 'Mayo',
        "6" => 'Junio',
        "7" => 'Julio',
        "8" => 'Agosto',
        "9" => 'Septiembre',
        "10" => 'Octubre',
        "11" => 'Noviembre',
        "12" => 'Diciembre',
    ];

    public function __construct()
    {
        // parent::__construct();

        $this->reportes = new Reportes();
        //set header type pdf
    }


    public function tarjetaControl($id)
    {


        $inscripcion = Inscripcion::listAll([], $id)->first();

        if (empty($inscripcion->id_inscripcion)) {
            abort(404);
        }

        //set header type pdf

        $datos['inscripcion'] = $inscripcion;
        $inscripcion = Inscripcion::find($id);
        $datos['entrenador'] = $inscripcion->grupoEntrenamiento->entrenador;
        $datos["pagos"] = $inscripcion->getPagosInscripcion($inscripcion->codigo);

        // dd($datos);

        $this->reportes->tarjetaControl($datos);

        exit;
    }

    public function credencialInscripcion($id)
    {

        $inscripcion = Inscripcion::listAll([], $id)->first();

        if (empty($inscripcion->id_inscripcion)) {
            abort(404);
        }

        //set header type pdf

        $datos['inscripcion'] = $inscripcion;
        $inscripcion = Inscripcion::find($id);

        // dd($datos);

        $this->reportes->credencialInscripcion($datos);

        exit;
    }



    public function pagosInscripcion(Request $request, $id)
    {


        $inscripcion = Inscripcion::listAll([], $id)->first();


        if (empty($inscripcion->id_inscripcion)) {
            abort(404);
        }

        $filtros["i.id_inscripcion"] = $id;
        empty($request->input('id_gestion')) ?: $filtros["pmg.id_gestion"] = $request->input('id_gestion');
        empty($request->input('estado_pago')) ?: $filtros["estado_pago"] = $request->input('estado_pago');


        $pagos = Inscripcion::getPagosInscripcion($filtros)->get();

        $datos['inscripcion'] = $inscripcion;
        $inscripcion = Inscripcion::find($id);
        $datos['entrenador'] = $inscripcion->grupoEntrenamiento->entrenador;
        $datos["pagos"] = $pagos;

        // dd($datos);

        $this->reportes->pagosInscripcion($datos);

        exit;
    }


    public function seguimiento($idValoracion)
    {

        $datosValoracion = Valoracion::findOrfail($idValoracion);
        $valoracion = Valoracion::getValoracion($idValoracion)->get();


        // if(empty($valoracion->id_valoracion_caracteristica)){
        //     abort(404);
        // }

        $datos['valoracion'] = $valoracion;
        $datos["caracteristicas"] = Valoracion::getCaracteristicasAtributo()->get();
        $datos["inscripcion"] = Valoracion::listAll([], $datosValoracion->id_inscripcion_fk)->first();
        $datos["datosValoracion"] = $datosValoracion;

        $this->reportes->tablaValoracion($datos);

        exit;
    }

    public function asistencia()
    {



        $idGrupoEntrenamiento = request()->input('idGrupoEntrenamiento');

        $fechaMesSeleccionado =  request()->input('fechaMesSeleccionado');

        $fechaMesSeleccionado = date('Y-m-d', strtotime(str_replace('/', '-', $fechaMesSeleccionado)));

        $mes = (int) date('m', strtotime($fechaMesSeleccionado));
        $anio = date('Y', strtotime($fechaMesSeleccionado));



        $data['asistencias'] = Inscripcion::getAsistenciasGrupo($idGrupoEntrenamiento, $mes, $anio);
        $data['grupo'] = GrupoEntrenamiento::getGrupoEntrenamiento($idGrupoEntrenamiento)->first();
        $data['mes'] = $this->meses[$mes];
        $data['nroMes'] = $mes;
        $data['anio'] = $anio;


        // return var_dump($data['grupo']);

        $this->reportes->tablaAsistencia($data);

        exit;
    }
}
