<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pagina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PaginaController extends Controller
{
    public function index(Request $request)
    {
        $idBloque = $request->input('id_bloque');
        $buscar = $request->input('buscar', '');

        $query = DB::table('weps_pagina')
            ->select(
                'weps_pagina.*',
            )
            ->where('weps_pagina.id_bloque', $idBloque);

        if (!empty($buscar)) {
            $query->where('weps_pagina.titulo', 'LIKE', "%{$buscar}%");
        }

        $paginas = $query->orderBy('weps_pagina.id', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $paginas,
            'total' => $paginas->count()
        ]);
    }

    public function show($id)
    {
        $pagina = DB::table('weps_pagina')
            ->leftJoin('weps_persona', 'weps_pagina.id_persona', '=', 'weps_persona.id_persona')
            ->select(
                'weps_pagina.*',
                'weps_persona.nombre as persona_nombres',
                'weps_persona.paterno as persona_apellido'
            )
            ->where('weps_pagina.id', $id)
            ->first();

        if (!$pagina) {
            return response()->json([
                'success' => false,
                'message' => 'Página no encontrada'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $pagina
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'enlace' => 'required',
            'compartidas' => 'nullable|integer|min:0',
            'me_gusta' => 'nullable|integer|min:0',
            'id_bloque' => 'required|integer',
            'id_persona' => 'nullable|integer',
        ], [
            'titulo.required' => 'El título es obligatorio.',
            'enlace.required' => 'El enlace es obligatorio.',
            'id_bloque.required' => 'El bloque político es obligatorio.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $id = DB::table('weps_pagina')->insertGetId([
                'titulo' => strtoupper($request->titulo),
                'enlace' => $request->enlace,
                'compartidas' => $request->compartidas ?? 0,
                'me_gusta' => $request->me_gusta ?? 0,
                'id_bloque' => $request->id_bloque,
                'id_persona' => $request->id_persona ?: null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Página registrada correctamente',
                'data' => ['id' => $id]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar la página',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $pagina = DB::table('weps_pagina')->where('id', $id)->first();

        if (!$pagina) {
            return response()->json([
                'success' => false,
                'message' => 'Página no encontrada'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'enlace' => 'required',
            'compartidas' => 'nullable|integer|min:0',
            'me_gusta' => 'nullable|integer|min:0',
            'id_persona' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::table('weps_pagina')->where('id', $id)->update([
                'titulo' => strtoupper($request->titulo),
                'enlace' => $request->enlace,
                'compartidas' => $request->compartidas ?? 0,
                'me_gusta' => $request->me_gusta ?? 0,
                'id_persona' => $request->id_persona ?: null,
                'updated_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Página actualizada correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la página',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $pagina = DB::table('weps_pagina')->where('id', $id)->first();

        if (!$pagina) {
            return response()->json([
                'success' => false,
                'message' => 'Página no encontrada'
            ], 404);
        }

        try {
            DB::table('weps_pagina')->where('id', $id)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Página eliminada correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la página',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
