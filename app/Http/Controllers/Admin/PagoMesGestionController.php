<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\PagoMesGestion;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;


class PagoMesGestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        $request->validate(PagoMesGestion::$rules, PagoMesGestion::$messages, PagoMesGestion::$customAttributes);

        // return $request->all();

        $pagoMesGestion = PagoMesGestion::create($request->all());

        if (empty($pagoMesGestion->id_pago_mes_gestion)) {
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar el pago'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Pago registrado correctamente',
            // 'data' => $pagoMesGestion
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($idPagoMesGestion)
    {

        $pagoMesGestion = PagoMesGestion::findOrfail($idPagoMesGestion);
        return response()->json([
            'success' => true,
            'message' => 'Pago encontrado',
            'data' => $pagoMesGestion
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PagoMesGestion $pagoMesGestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idPagoMesGestion)
    {


        $pagoMesGestion = PagoMesGestion::findOrfail($idPagoMesGestion);

        $rules = PagoMesGestion::$rules;

        unset($rules['id_gestion'], $rules['id_inscripcion'], $rules['fecha_pago'], $rules['id_mes_fk']);

        $request->validate($rules, PagoMesGestion::$messages, PagoMesGestion::$customAttributes);

        unset($request['id_gestion'], $request['id_inscripcion'], $request['fecha_pago'], $request['id_mes_fk']);

        // return $request->all();

        $resultado = $pagoMesGestion->update($request->all());

        if (!$resultado) {
            return response()->json([
                'success' => false,
                'errors' => 'Pago no actualizado, intente nuevamente.',
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'Pago actualizado correctamente',
            'data' => $pagoMesGestion
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PagoMesGestion $pagoMesGestion)
    {
        //
    }
}
