<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.academia.indexCategoria');
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
        $request->validate(Categoria::$rules);

        $categoria = Categoria::create($request->all());

        if (empty($categoria->id_categoria)) {
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar la categoria'
            ]);
        }
        $categoria->estado = 'ACTIVO';

        return response()->json([
            'success' => true,
            'message' => 'Distrito registrado correctamente',
            'data' => $categoria,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($idCategoria)
    {
        $categoria = Categoria::findOrfail($idCategoria);

        return response()->json([
            'success' => true,
            'data' => $categoria,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idCategoria)
    {

        $categoria = Categoria::findOrfail($idCategoria);

        if ($request->isMethod('put')) {

            $rules = Categoria::$rules;
            $rules['nombre_categoria'] = 'required|max:255|min:5|unique:weps_categoria,nombre_categoria,' . $idCategoria . ',id_categoria';

            $request->validate($rules);
        }

        $result = $categoria->update($request->all());

        return response()->json([
            'success' => $result,
            'message' => $result ? 'Distrito actualizado correctamente' : 'Error al actualizar el distrito',
            'data' => $categoria,
        ], $result ? 200 : 422);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idCategoria)
    {
        $categoria = Categoria::findOrfail($idCategoria);

        $result = $categoria->delete();

        return response()->json([
            'success' => $result,
            'message' => $result ? 'Distrito eliminada correctamente' : 'Error al eliminar el distrito',
        ], $result ? 200 : 422);

    }

    public function getAll(Request $request)
    {

        $limit = $request->input('size', 10);
        $page = $request->input('page', 1);

        $data = Categoria::getAllCategoria($request->all())
            ->paginate($limit, ['*'], 'page', $page);

        $listado = $data->items();

        return  response()->json([
            'datos' => $listado,
            'total' => $data->total(),
            'page' => $data->currentPage(),
        ]);
    }
}
