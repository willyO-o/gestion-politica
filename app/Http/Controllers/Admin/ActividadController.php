<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Actividad;


class ActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (request()->ajax()) {

            $search = request()->get('search', '');
            $search = convMayuscula(str_replace(' ', '%', $search));

            $actividades = Actividad::orderBy('fecha_actividad', 'desc');
            if (!empty($search)) {
                $actividades->where(function ($query) use ($search) {
                    $query->where('nombre_actividad', 'like', '%' . $search . '%')
                        ->orWhere('descripcion', 'like', '%' . $search . '%');
                });
            }
            $actividades = $actividades->paginate(10);

            return response()->json([
                'datos' => $actividades->items(),
                'total' => $actividades->total(),
                'page' => $actividades->currentPage(),
            ]);

        }
        return view('admin.asistencia.indexActividad');
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $actividad = new Actividad();

        return view('admin.asistencia.formActividad',compact('actividad'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(Actividad::$rules, Actividad::$messages);

        $actividad = Actividad::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Actividad creada exitosamente',
            'data' => $actividad,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $actividad = Actividad::findOrFail($id);
        return view('admin.asistencia.formActividad', compact('actividad'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(Actividad::$rules, Actividad::$messages);
        $actividad = Actividad::findOrFail($id);
        $actividad->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Actividad actualizada exitosamente',
            'data' => $actividad,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $actividad = Actividad::findOrFail($id);
        $actividad->delete();
        return response()->json([
            'success' => true,
            'message' => 'Actividad eliminada exitosamente',
        ]);
    }
}
