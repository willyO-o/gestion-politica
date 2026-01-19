<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Sucursal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.academia.indexSucursal');
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

        $request->validate(Sucursal::$rules);

        $sucursal = Sucursal::create($request->all());

        if (empty($sucursal->id_sucursal)) {
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar la sucursal'
            ]);
        }
        $sucursal->estado_sucursal = 'ACTIVO';

        return response()->json([
            'success' => true,
            'message' => 'Sucursal registrada correctamente',
            'data' => $sucursal,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($diSucursal)
    {
        $sucursal = Sucursal::findOrfail($diSucursal);

        return response()->json([
            'success' => true,
            'data' => $sucursal,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sucursal $sucursal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $idSucursal)
    {
        $sucursal = Sucursal::findOrfail($idSucursal);


        if ($request->isMethod('put')) {

            $rules= Sucursal::$rules;
            $rules['nombre_sucursal'] = 'required|max:255|min:5|unique:weps_sucursal,nombre_sucursal,'.$idSucursal.',id_sucursal';

            $request->validate($rules);

        }


        $result = $sucursal->update($request->all());

        return response()->json([
            'success' => $result,
            'message' => $result ? 'Sucursal actualizada correctamente' : 'Error al actualizar la sucursal',
            'data' => $sucursal,
        ], $result ? 200 : 422);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $idSucursal)
    {
        $sucursal = Sucursal::findOrfail($idSucursal);

        $result = $sucursal->delete();

        return response()->json([
            'success' => $result,
            'message' => $result ? 'Sucursal eliminada correctamente' : 'Error al eliminar la sucursal',
        ], $result ? 200 : 422);
    }

    public function getParametrico()
    {

        $sucursal = Sucursal::select('id_sucursal', 'nombre_sucursal')->where('estado_sucursal', 'ACTIVO')->get();
        return response()->json([
            'success' => true,
            'data' => $sucursal,
        ]);
    }

    public function getAll(Request $request)
    {


        $limit = $request->input('size', 10);
        $page = $request->input('page', 1);

        $data = Sucursal::getAllSucursal($request->all())
            ->paginate($limit, ['*'], 'page', $page);

        $listado = $data->items();

        return  response()->json([
            'datos' => $listado,
            'total' => $data->total(),
            'page' => $data->currentPage(),
        ]);
    }
}
