<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Persona;
use App\Models\Admin\TipoPersona;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipoPersona = TipoPersona::where('estado_tipo', 'ACTIVO')->get();

        $estadoPersona = Persona::select('estado_persona')->distinct()->get();

        return view('admin.persona.indexPersona')
            ->with('estadoPersona', $estadoPersona)
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
        $request->validate(Persona::$rules, Persona::$messages, Persona::$customAttributes);

        DB::beginTransaction();

        try {

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

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Persona registrada correctamente',
                'data' => Persona::listAll([], $persona->id_persona)->first(),
            ]);
        } catch (\Throwable $th) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'errors' => $th->getMessage(),
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($idPersona)
    {
        $persona = Persona::listAll([], $idPersona)->first();

        if (empty($persona->id_persona)) {
            return response()->json([
                'success' => false,
                'errors' => 'Persona no encontrada',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $persona,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Persona $persona)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idPersona)
    {

        $persona = Persona::findOrfail($idPersona);


        $rules = Persona::$rules;
        $rules['numero_documento'] = $rules['numero_documento'] . ',' . $persona->id_persona . ',id_persona';
        $request->validate($rules, Persona::$messages, Persona::$customAttributes);


        DB::beginTransaction();

        try {

            $imageB64 = $request->input('imagen_b64');

            if (!empty($imageB64)) {
                $foto = Persona::storeImage($imageB64);

                if (empty($foto)) {
                    throw new \Exception("Error al guardar la imagen", 1);
                }

                $request->merge(['foto' => $foto]);
            }

            $result = $persona->update($request->all());

            if ($result != true) {
                throw new \Exception("Error al actualizar la persona", 1);
            }


            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Persona Actualizada correctamente',
                'data' => Persona::listAll([], $persona->id_persona)->first(),
            ]);
        } catch (\Throwable $th) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'errors' => $th->getMessage(),
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idPersona)
    {
        $persona = Persona::findOrfail($idPersona);

        $resultado = $persona->delete();

        return response()->json([
            'success' => $resultado ? true : false,
            'message' => $resultado ? 'Persona eliminada correctamente' : 'No se pudo eliminar a la persona',
        ], $resultado ? 200 : 422);
    }

    public function getAll(Request $request)
    {



        $limit = $request->input('size', 10);
        $offset = $request->input('page', 1);

        $list = Persona::listAll($request->all())->paginate($limit, ['*'], 'page', $offset);

        $data = [
            'datos' => $list->items(),
            'total' => $list->total(),
            'page' => $list->currentPage(),
        ];

        return response()->json($data);
    }

    public function updatePhoto(Request $request, $id)
    {

        // return $request->all();
        $persona = Persona::findOrfail($id);

        $imageB64 = $request->input('imagen_b64');

        DB::beginTransaction();

        try {

            $imageB64 = $request->input('imagen_b64');

            if (!empty($imageB64)) {
                $foto = Persona::storeImage($imageB64);

                if (empty($foto)) {
                    throw new \Exception("Error al guardar la imagen", 1);
                }

                $request->merge(['foto' => $foto]);
            }

            $persona->foto = $foto;
            $result = $persona->save();

            if (empty($result)) {
                throw new \Exception("Error al actualizar la Foto", 1);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Foto de la Persona actualizada correctamente',
                'data' => Persona::listAll([], $persona->id_persona)->first(),
            ]);
        } catch (\Throwable $th) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'errors' => $th->getMessage(),
            ], 422);
        }
    }


    public function searchPersona(Request $request)
    {

        $list = Persona::search($request->all())->get();


        return response()->json($list);
    }




    public function buscarEstudiante(Request $request)
    {
        $list = Persona::buscarEstudiante($request->all())->get();

        return response()->json($list);

    }


}
