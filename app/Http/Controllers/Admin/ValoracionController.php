<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Gestion;
use App\Models\Admin\Persona;
use App\Models\Admin\Valoracion;
use App\Models\Admin\Inscripcion;
use App\Models\Admin\TipoPersona;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Admin\ValoracionAtributo;
use App\Models\Admin\ValoracionCaracteristica;

class ValoracionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipoPersona = TipoPersona::where('estado_tipo', 'ACTIVO')->get();

        $estadoPersona = Inscripcion::select('estado_inscripcion')->distinct()->get();

        $meses = DB::table('weps_mes')->orderBy('id_mes')->get();
        $gestiones =  Gestion::orderBy('id_gestion', 'DESC')->get();
        return view('admin.valoracion.indexValoracion')
            ->with('estadoPersona', $estadoPersona)
            ->with('meses', $meses)
            ->with('gestiones', $gestiones)
            ->with('tipoPersona', $tipoPersona);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return response()->json($request->all());

        $caracteristicas = $request->input('caracteristicas');
        $observaciones = $request->input('observaciones');
        $valoraciones = $request->input('valoracion');

        DB::beginTransaction();

        try {

            $correlativo = Valoracion::getCorrelativoValoracion($request->input('id_inscripcion_fk'));

            $datosValoracion = [
                "correlativo_valoracion" => $correlativo,
                "numero_valoracion" => Valoracion::generarNumeroValoracion($correlativo, $request->input('fecha_valoracion')),
            ];

            $request->merge($datosValoracion);

            $valoracion = Valoracion::create($request->all());

            if (empty($valoracion->id_valoracion)) {
                throw new \Exception("Error al registrar la valoracion");
            }

            $datosCaracteristicaValoracion = [];

            foreach ($caracteristicas as $caracteristica) {



                $observacion = $observaciones[$caracteristica];


                $datosCaracteristicaValoracion = [
                    "id_caracteristica_fk" => $caracteristica,
                    "id_valoracion_fk" => $valoracion->id_valoracion,
                    "observacion_valoracion" => $observacion,
                ];

                $caracteristicaValoracion = ValoracionCaracteristica::create($datosCaracteristicaValoracion);

                if (empty($caracteristicaValoracion->id_valoracion_caracteristica)) {
                    throw new \Exception("Error al registrar la valoracion");
                }

                $valoracionesAtributos = $valoraciones[$caracteristica];

                foreach ($valoracionesAtributos as $key => $valoracionAtributo) {

                    $datosValoracionAtributo = [
                        "id_caracteristica_fk" => $caracteristica,
                        "id_atributo_fk" => $key,
                        "id_valoracion_fk" => $valoracion->id_valoracion,
                        "valor" => $valoracionAtributo,
                    ];

                    if (empty($valoracionAtributo)) {

                        continue;
                    }

                    $valoracionAtributo = ValoracionAtributo::create($datosValoracionAtributo);

                    if (empty($valoracionAtributo->id_valoracion_atributo)) {
                        throw new \Exception("Error al registrar la valoracion");
                    }
                }
            }


            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Seguimiento y Valoraciones registrados correctamente',
                'data' => Valoracion::listAll([], $valoracion->id_valoracion)->first(),
            ], 200);
        } catch (\Throwable $th) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Error al registrar la valoracion',
                'errors' => $th->getMessage(),
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Valoracion $valoracion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Valoracion $valoracion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Valoracion $valoracion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Valoracion $valoracion)
    {
        //
    }


    public function getAll(Request $request)
    {
        $limit = $request->input('size', 10);
        $offset = $request->input('page', 1);

        $list = Valoracion::listAll($request->all())->paginate($limit, ['*'], 'page', $offset);

        $data = [
            'datos' => $list->items(),
            'total' => $list->total(),
            'page' => $list->currentPage(),
        ];

        return response()->json($data);
    }

    public function getCaracteristicasAtributo()
    {
        $caracteristicas = Valoracion::getCaracteristicasAtributo()->get();

        return response()->json($caracteristicas);
    }


    public function getSeguimientosInscripcion($idInscripcion)
    {
        $seguimientos = Valoracion::where('id_inscripcion_fk', $idInscripcion)->orderBy('fecha_valoracion', 'DESC')->get();

        return response()->json([
            'success' => true,
            'data' => $seguimientos,
        ]);
    }


    public static function getValoracionAtributo($idValoracion)
    {

        $valoracionAtributo = Valoracion::getValoracion($idValoracion)->get();

        return response()->json([
            'success' => true,
            'data' => $valoracionAtributo,
        ]);

    }

}
