<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Gestion;

use App\Models\Admin\Persona;
use App\Models\Admin\Inscripcion;
use App\Models\Admin\TipoPersona;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Admin\GrupoEntrenamiento;

class InscripcionController extends Controller
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

        return view('admin.inscripcion.indexInscripcion')
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
        // return $request->all();

        $rules = Inscripcion::$rules;
        $messages = Inscripcion::$messages;
        $customAttributes = Inscripcion::$customAttributes;


        $nuevaPersona = $request->input('nueva_persona');

        if ($nuevaPersona == 'on') {

            unset($rules['id_persona']);
            $rulesPersona = Persona::$rules;
            $messagesPersona = Persona::$messages;
            $customAttributesPersona = Persona::$customAttributes;

            $rules = array_merge($rules, $rulesPersona);
            $messages = array_merge($messages, $messagesPersona);
            $customAttributes = array_merge($customAttributes, $customAttributesPersona);
        }

        $request->validate($rules, $messages, $customAttributes);

        DB::beginTransaction();

        try {


            if ($nuevaPersona == 'on') {

                $imageB64 = $request->input('imagen_b64');

                if (!empty($imageB64)) {
                    $foto = Persona::storeImage($imageB64);

                    if (empty($foto)) {
                        throw new \Exception("Error al guardar la imagen", 1);
                    }

                    $request->merge(['foto' => $foto]);
                }

                $persona = Persona::create($request->all());

                if (empty($persona->id_persona)) {
                    throw new \Exception("Error al guardar la persona", 1);
                }

                $request->merge(['id_persona' => $persona->id_persona]);
            }


            $correlativo = Inscripcion::getCorrelativo();
            $datosAd = [
                "fecha_registro" => date("Y-m-d"),
                "correlativo_gestion" => $correlativo,
                "codigo" => uniqid(),
                "numero" => Inscripcion::generarNumero($correlativo),
            ];

            $request->merge($datosAd);

            $inscripcion = Inscripcion::create($request->all());

            if (empty($inscripcion->id_inscripcion)) {
                throw new \Exception("Error al guardar la inscripcion", 1);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Inscripcion registrada correctamente',
                'data' => Inscripcion::listAll([], $inscripcion->id_inscripcion)->first(),
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'errors' => $e->getMessage(),
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($idInscripcion)
    {
        $inscripcion = Inscripcion::listAll([], $idInscripcion)->first();

        if (empty($inscripcion->id_inscripcion)) {
            return response()->json([
                'success' => false,
                'errors' => 'Inscripcion no encontrada',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $inscripcion,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inscripcion $inscripcion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $idInscripcion)
    {

        $inscripcion = Inscripcion::findOrfail($idInscripcion);
        $rules = Inscripcion::$rules;
        unset($rules['id_persona']);
        $request->validate($rules, Inscripcion::$messages, Inscripcion::$customAttributes);


        $resultado = $inscripcion->update($request->all());

        if (!$resultado) {
            return response()->json([
                'success' => false,
                'errors' => 'Inscripcion no actualizada',
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'Inscripcion actualizada correctamente',
            'data' => Inscripcion::listAll([], $inscripcion->id_inscripcion)->first(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idInscripcion)
    {
        $inscripcion = Inscripcion::findOrfail($idInscripcion);

        $resultado = $inscripcion->delete();

        return response()->json([
            'success' => $resultado,
            'errors' => $resultado ? 'Inscripcion  Eliminada Correctametne' : "No se puedo eliminar la inscripción, porque contiene registros de pagos",
        ],$resultado ? 200 : 422);
    }

    public function getAll(Request $request)
    {
        $limit = $request->input('size', 10);
        $offset = $request->input('page', 1);

        $list = Inscripcion::listAll($request->all())->paginate($limit, ['*'], 'page', $offset);

        $data = [
            'datos' => $list->items(),
            'total' => $list->total(),
            'page' => $list->currentPage(),
        ];

        return response()->json($data);
    }

    public function getParametrico(Request $request)
    {

        $tipo = $request->input('tipo');
        $data = [];

        if ($tipo == 'sucursal' || $tipo == 'all') {

            $data["sucursal"] = DB::table("weps_sucursal")->select('id_sucursal', 'nombre_sucursal')->where('estado_sucursal', 'ACTIVO')->get();
        }

        if ($tipo == 'grupo' || $tipo == 'all') {

            $data["grupo"] = GrupoEntrenamiento::getParam()->get();
        }

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }


    public function getPagosInscripcion(Request $request, $idInscripcion)
    {

        $filtros["i.id_inscripcion"] = $idInscripcion;
        empty($request->input('id_gestion')) ?: $filtros["pmg.id_gestion"] = $request->input('id_gestion');
        empty($request->input('estado_pago')) ?: $filtros["estado_pago"] = $request->input('estado_pago');

        $pagos = Inscripcion::getPagosInscripcion($filtros)->get();

        return response()->json([

            'success' => true,
            'data' => $pagos,
        ]);
    }
}
