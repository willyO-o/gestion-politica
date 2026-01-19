<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Asistencia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Inscripcion;
use App\Models\Admin\GrupoEntrenamiento;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (request()->ajax()) {

            $idGrupoEntrenamiento = request()->input('idGrupoEntrenamiento');

            $fechaMesSeleccionado =  request()->input('fechaMesSeleccionado');

            $fechaMesSeleccionado = date('Y-m-d', strtotime(str_replace('/', '-', $fechaMesSeleccionado)));

            $mes = date('m', strtotime($fechaMesSeleccionado));
            $anio = date('Y', strtotime($fechaMesSeleccionado));


            $data = Inscripcion::getAsistenciasGrupo($idGrupoEntrenamiento, $mes, $anio);


            return  response()->json($data);
        }


        return view('admin.asistencia.indexAsistenciaEstudiante');
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

        $request->validate(Asistencia::$rules, Asistencia::$messages);
        // convertir formato de hora "HH:mm" a "Y-m-d HH:mm:ss"


        $asistencia = Asistencia::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $asistencia,
            'message' => 'Se registro la asistencia del estudiante.'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($idAsistencia)
    {
        $asistencia = Asistencia::getListaAsistencias([])->where('id_asistencia', $idAsistencia)->first();

        if (empty($asistencia->id_asistencia)) {
            return response()->json([
                'error' => 'No se encontro la asistencia del estudiante.'
            ], 404);
        }


        $diasEntrenamiento = GrupoEntrenamiento::getDiasEntrenamiento($asistencia->id_grupo_entrenamiento);

        $asistencia->dias_entrenamiento = $diasEntrenamiento;

        return response()->json([
            'success' => true,
            'data' => $asistencia
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asistencia $asistencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $idAsistencia)
    {

        $asistencia = Asistencia::findOrfail($idAsistencia);

        $request->validate(Asistencia::$rules, Asistencia::$messages);

        $asistencia->update($request->all());


        return response()->json([
            'success' => true,
            'message' => 'Se actualizó la asistencia del estudiante.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idAsistencia)
    {
        $asistencia = Asistencia::findOrfail($idAsistencia);

        $asistencia->delete();

        return response()->json([
            'success' => true,
            'message' => 'Se eliminó la asistencia del estudiante.',
        ]);
    }

    public function indexMarcado(Request $request)

    {
        return view('admin.asistencia.indexMarcadoAsistencia');
    }

    public function asistenciaEstudiante(Request $request)
    {

        $codigo = $request->input('codigo');

        $inscripcion = Inscripcion::getInscripcionCodigo($codigo)->first();

        if (empty($inscripcion->id_inscripcion)) {

            return response()->json([
                'error' => 'No se encontro la inscripcion del estudiante con el codigo ingresado.'
            ], 404);
        }




        $asistencia = Asistencia::getAsistenciaActualInscripcion($inscripcion->id_inscripcion)->first();

        if (empty($asistencia)) {
            $datosAsistencia = [
                'id_inscripcion_fk' => $inscripcion->id_inscripcion,
                'id_grupo_entrenamiento_fk' => $inscripcion->id_grupo_entrenamiento,
                'fecha_asistencia' => now()->format('Y-m-d'),
                'ingreso' => now()->format('H:i'),
                'estado_asistencia' => 'REGISTRADO',
                'permiso' => 0
            ];

            $validator = \Validator::make($datosAsistencia, Asistencia::$rules, Asistencia::$messages);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Error al registrar la asistencia del estudiante.',
                    'errors' => $validator->errors()
                ], 422);
            }
        }

        return response()->json([
            'success' => true,
            'data' => [
                'inscripcion' => $inscripcion,
                'asistencia' => $asistencia
            ]
        ]);
    }

    public function asistenciaEstudianteRegistrar(Request $request)
    {

        $idInscripcion = $request->input('idInscripcion');

        $inscripcion = Inscripcion::findOrfail($idInscripcion);

        $idAsistencia = $request->input('idAsistencia');

        if (empty($idAsistencia) == false) {
            $asistencia = Asistencia::findOrfail($idAsistencia);

            if ($asistencia->salida != null) {
                return response()->json([
                    'message' => 'El estudiante ya marco su salida.',
                    'errors' => 'El estudiante ya marco su salida.'
                ], 404);
            }

            $asistencia->salida = now()->format('H:i');

            $asistencia->save();

            return response()->json([
                'success' => true,
                'data' => $asistencia,
                'message' => 'Se registro la salida del estudiante.'
            ]);
        }

        $datosAsistencia = [
            'id_inscripcion_fk' => $inscripcion->id_inscripcion,
            'id_grupo_entrenamiento_fk' => $inscripcion->id_grupo_entrenamiento,
            'fecha_asistencia' => now()->format('Y-m-d'),
            'ingreso' => now()->format('H:i'),
            'estado_asistencia' => 'REGISTRADO',
            'permiso' => 0
        ];

        $validator = \Validator::make($datosAsistencia, Asistencia::$rules, Asistencia::$messages);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error al registrar la asistencia del estudiante.',
                'errors' => $validator->errors()
            ], 422);
        }
        // return var_dump($datosAsistencia);


        $asistencia = Asistencia::create($datosAsistencia);

        return response()->json([
            'success' => true,
            'data' => $asistencia,
            'message' => 'Se registro la asistencia del estudiante.'
        ]);
    }

    public function getListaAsistencias(Request $request)
    {

        // return var_dump($request->all());
        $filtros = $request->all();
        $limit = $request->input('size');
        $page = $request->input('page');

        $data = Asistencia::getListaAsistencias($filtros)
            ->paginate($limit, ['*'], 'page', $page);

        $listado = $data->items();

        return  response()->json([
            'datos' => $listado,
            'total' => $data->total(),
            'page' => $data->currentPage(),
        ]);
    }
}
