<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Categoria;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Admin\GrupoEntrenamiento;

class GrupoEntrenamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $diasData;

    public function index()
    {

        $dias = DB::table('weps_dia')->get();
        $gestiones = DB::table('weps_gestion')->orderBy('gestion', 'desc')->get();

        return view('admin.academia.indexGrupoEntrenamiento')->with('dias', $dias)->with('gestiones', $gestiones);


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

        $request->validate(GrupoEntrenamiento::$rules);

        try {

            DB::beginTransaction();

            $datosRegistrar = $request->all();

            unset($datosRegistrar['dias'], $datosRegistrar['dia_extra']);

            $this->diasData = $this->getDias();

            $dias = $request->input('dias');
            $datosRegistrar["dia"] = $this->extraerDiasTexto($dias);

            $diaExtra = $request->input('dia_extra');
            $datosRegistrar["dia_extra"] = $this->extraerDiasTexto($diaExtra);
            $datosRegistrar["estado_grupo"] = "ACTIVO";

            $grupoEntrenamiento = GrupoEntrenamiento::create($datosRegistrar);

            if (empty($grupoEntrenamiento->id_grupo_entrenamiento)) {
                throw new \Exception("Error al registrar el grupo de entrenamiento");
            }

            $this->registrarDias($grupoEntrenamiento->id_grupo_entrenamiento, $dias);

            $this->registrarDias($grupoEntrenamiento->id_grupo_entrenamiento, $diaExtra, 1);



            DB::commit();


            return response()->json([
                'success' => true,
                'message' => "Grupo de entrenamiento registrado correctamente",
                'data' => GrupoEntrenamiento::getAllGrupos([], $grupoEntrenamiento->id_grupo_entrenamiento)->first(),
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }


    private function extraerDiasTexto($dias)
    {

        if (empty($dias)) {
            return null;
        }

        $diasTexto = "";

        foreach ($dias as $dia) {
            $diasTexto .= $this->diasData[$dia] . ", ";
        }

        return substr($diasTexto, 0, -2);
    }


    private function getDias()
    {

        $diasData = DB::table('weps_dia')->get();
        $arrayDias = $diasData->mapWithKeys(function ($item) {
            return [$item->id_dia => $item->nombre_dia];
        });

        return $arrayDias;
    }

    private function registrarDias($idGrupoEntrenamiento, $listaDias, $esDiaExtra = 0)
    {
        if (empty($listaDias)) {
            return true;
        }

        foreach ($listaDias as $dia) {
            $insertado = DB::table("weps_dia_grupo_entrenamiento")->insert([
                'id_grupo_entrenamiento_fk' => $idGrupoEntrenamiento,
                'id_dia_fk' => $dia,
                'es_dia_extra' => $esDiaExtra
            ]);

            if (!$insertado) {
                throw new \Exception("Error al registrar los dias de entrenamiento " . ($esDiaExtra == 0 ? "" : " extra"));
            }
        }

        return true;
    }

    /**
     * Display the specified resource.
     */
    public function show($idGrupoEntrenamiento)
    {
        $grupoEntrenamiento = GrupoEntrenamiento::getAllGrupos([], $idGrupoEntrenamiento)->first();

        if (empty($grupoEntrenamiento->id_grupo_entrenamiento)) {
            return response()->json([
                'success' => false,
                'message' => "Grupo de entrenamiento no encontrado",
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $grupoEntrenamiento,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($grupoEntrenamiento)
    {
        // $datos=DB::table('weps_grupo_entrenamiento')->where('id_grupo_entrenamiento', 15)->first();

        // $diasExtraArray = explode(",", $datos->dia_extra);


        // return var_dump($diasExtraArray);

        // try {

        //     DB::beginTransaction();

        //     $datos = DB::table('weps_grupo_entrenamiento as ge')->get();

        //     $diasArr = [
        //         "1" => "Lunes",
        //         "2" => "Martes",
        //         "3" => "Miercoles",
        //         "4" => "Jueves",
        //         "5" => "Viernes",
        //         "6" => "Sabado",
        //         "7" => "Domingo"
        //     ];

        //     $diaLiteraArr = [
        //         "LUNES" => "1",
        //         "MARTES" => "2",
        //         "MIERCOLES" => "3",
        //         "JUEVES" => "4",
        //         "VIERNES" => "5",
        //         "SABADO" => "6",
        //         "DOMINGO" => "7"
        //     ];

        //     foreach ($datos as $dato) {

        //         $diasArray = explode(",", $dato->dia);
        //         $diasExtraArray = explode(",", $dato->dia_extra);


        //         foreach ($diasArray as $dia) {

        //             $dia = mb_strtoupper(trim($dia));

        //             $datosInsertar = [
        //                 "id_dia_fk" => $diaLiteraArr[$dia],
        //                 "id_grupo_entrenamiento_fk" => $dato->id_grupo_entrenamiento,
        //                 "es_dia_extra" => 0
        //             ];

        //             $existente = DB::table('weps_dia_grupo_entrenamiento')->where('id_grupo_entrenamiento_fk', $dato->id_grupo_entrenamiento)->where('id_dia_fk', $diaLiteraArr[$dia])->where('es_dia_extra', 0)->first();

        //             if (empty($existente)) {
        //                 $resultado = DB::table('weps_dia_grupo_entrenamiento')->insert($datosInsertar);

        //                 if (!$resultado) {
        //                     throw new \Exception("Error al registrar los dias de entrenamiento");
        //                 }
        //             }
        //         }



        //         if ((trim($diasExtraArray[0]) != "")) {



        //             foreach ($diasExtraArray as $dia) {

        //                 $dia = mb_strtoupper(trim($dia));

        //                 $datosInsertar = [
        //                     "id_dia_fk" => $diaLiteraArr[$dia],
        //                     "id_grupo_entrenamiento_fk" => $dato->id_grupo_entrenamiento,
        //                     "es_dia_extra" => 1
        //                 ];

        //                 $existente = DB::table('weps_dia_grupo_entrenamiento')->where('id_grupo_entrenamiento_fk', $dato->id_grupo_entrenamiento)->where('id_dia_fk', $diaLiteraArr[$dia])->where('es_dia_extra', 1)->first();

        //                 if (empty($existente)) {
        //                     $resultado = DB::table('weps_dia_grupo_entrenamiento')->insert($datosInsertar);

        //                     if (!$resultado) {
        //                         throw new \Exception("Error al registrar los dias de entrenamiento extra");
        //                     }
        //                 }
        //             }
        //         }
        //     }

        //     DB::commit();

        //     var_dump("Exitoso");
        // } catch (\Throwable $th) {

        //     DB::rollBack();

        //     var_dump($th->getMessage());
        // }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $idGrupoEntrenamiento)
    {


        $grupoEntrenamiento = GrupoEntrenamiento::findOrfail($idGrupoEntrenamiento);

        if ($request->isMethod('put')) {

            $rules = GrupoEntrenamiento::$rules;
            $rules['nombre_grupo'] = 'required|max:255|min:5|unique:weps_grupo_entrenamiento,nombre_grupo,' . $idGrupoEntrenamiento . ',id_grupo_entrenamiento';

            $request->validate($rules);
        }

        try {

            DB::beginTransaction();

            if ($request->isMethod('put')) {


                $datosRegistrar = $request->all();

                unset($datosRegistrar['dias'], $datosRegistrar['dia_extra']);

                $this->diasData = $this->getDias();

                $dias = $request->input('dias');
                $datosRegistrar["dia"] = $this->extraerDiasTexto($dias);

                $diaExtra = $request->input('dia_extra');
                $datosRegistrar["dia_extra"] = $this->extraerDiasTexto($diaExtra);
                $datosRegistrar["estado_grupo"] = "ACTIVO";

                $resultado = $grupoEntrenamiento->update($datosRegistrar);

                if (!$resultado) {
                    throw new \Exception("Error al actualizar el grupo de entrenamiento");
                }

                DB::table('weps_dia_grupo_entrenamiento')->where('id_grupo_entrenamiento_fk', $grupoEntrenamiento->id_grupo_entrenamiento)->delete();

                $this->registrarDias($grupoEntrenamiento->id_grupo_entrenamiento, $dias);

                $this->registrarDias($grupoEntrenamiento->id_grupo_entrenamiento, $diaExtra, 1);
            }


            if ($request->isMethod('patch')) {

                $resultado = $grupoEntrenamiento->update($request->all());

                if (!$resultado) {
                    throw new \Exception("Error al actualizar el grupo de entrenamiento");
                }
            }

            DB::commit();


            return response()->json([
                'success' => true,
                'message' => "Grupo de entrenamiento registrado correctamente",
                'data' => GrupoEntrenamiento::getAllGrupos([], $grupoEntrenamiento->id_grupo_entrenamiento)->first(),
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idGrupoEntrenamiento)
    {
        $grupoEntrenamiento = GrupoEntrenamiento::findOrfail($idGrupoEntrenamiento);

        $resultado = $grupoEntrenamiento->delete();

        if ($resultado) {
            return response()->json([
                'success' => $resultado,
                'message' => $resultado ? 'Grupo de entrenamiento eliminado correctamente' : 'Error al eliminar el grupo de entrenamiento',
            ], $resultado ? 200 : 422);
        }
    }

    public function getAll(Request $request)
    {

        $limit = $request->input('size', 10);
        $page = $request->input('page', 1);

        $data = GrupoEntrenamiento::getAllGrupos($request->all())->paginate($limit, ['*'], 'page', $page);

        $listado = $data->items();

        return  response()->json([
            'datos' => $listado,
            'total' => $data->total(),
            'page' => $data->currentPage(),
        ]);
    }

    public function getParametrico(Request $request)
    {

        $data["categorias"] = Categoria::where('estado', 'ACTIVO')->get();
        $data["entrenadores"] = DB::table('weps_persona')->where('estado_persona', 'ACTIVO')->get();
        $data["sucursales"] = DB::table('weps_sucursal')->where('estado_sucursal', 'ACTIVO')->get();


        return  response()->json([
            'success' => true,
            'datos' => $data,
        ]);
    }


    public function getGruposEntrenamiento()
    {
        $data = GrupoEntrenamiento::join('weps_categoria as c', 'c.id_categoria', 'weps_grupo_entrenamiento.id_categoria')
            ->join('weps_persona  as p', 'p.id_persona', 'weps_grupo_entrenamiento.id_entrenador')
            ->join('weps_sucursal as s', 's.id_sucursal', 'weps_grupo_entrenamiento.id_sucursal_fk')
            ->select('weps_grupo_entrenamiento.*', 'c.nombre_categoria', 'p.nombre', 'p.paterno','p.materno', 's.nombre_sucursal')
            ->orderBy('id_grupo_entrenamiento', 'desc')
            // ->where('weps_grupo_entrenamiento.estado_grupo', 'ACTIVO')
            ->get();

        return  response()->json($data);
    }


    public function getDiasEntrenamiento(Request $request)
    {
        $idGrupoEntrenamiento = $request->input('id_grupo_entrenamiento');

        $data = GrupoEntrenamiento::getDiasEntrenamiento($idGrupoEntrenamiento);

        return  response()->json($data);
    }
}
