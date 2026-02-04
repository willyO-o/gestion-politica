<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Admin\Asistencia;
use App\Models\Admin\Actividad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AsistenciaController extends Controller
{
    /**
     * Constructor - requiere autenticación para todos los métodos
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Registrar asistencia mediante código QR
     * POST /api/asistencia/qr
     */
    public function registrarPorQR(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'codigo' => 'required|string',
            'id_actividad_fk' => 'required|integer',
            'observacion' => 'nullable|string|max:2000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Datos inválidos',
                'errors' => $validator->errors()
            ], 422);
        }

        // Verificar que la actividad exista
        $actividad = Actividad::find($request->id_actividad_fk);
        if (!$actividad) {
            return response()->json([
                'success' => false,
                'message' => 'La actividad no existe o no está disponible',
                'tipo' => 'actividad_no_encontrada'
            ], 404);
        }

        // Buscar la persona que coincida con el código MD5
        $persona = DB::table('weps_persona')
            ->whereRaw('MD5(id_persona) = ?', [$request->codigo])
            ->first();

        if (!$persona) {
            return response()->json([
                'success' => false,
                'message' => 'Código QR inválido o persona no registrada',
                'tipo' => 'persona_no_encontrada'
            ], 404);
        }

        // Verificar si ya existe asistencia registrada para hoy
        $asistenciaExistente = Asistencia::where('id_actividad_fk', $request->id_actividad_fk)
            ->where('id_persona_fk', $persona->id_persona)
            ->whereDate('fecha_asistencia', Carbon::today())
            ->first();

        if ($asistenciaExistente) {
            $horaRegistro = Carbon::parse($asistenciaExistente->ingreso)->format('H:i:s');
            return response()->json([
                'success' => false,
                'message' => 'Ya registraste tu asistencia el día de hoy',
                'tipo' => 'asistencia_duplicada',
                'data' => [
                    'hora_entrada' => $horaRegistro,
                    'fecha' => $asistenciaExistente->fecha_asistencia,
                    'asistencia' => $asistenciaExistente
                ]
            ], 422);
        }

        // Crear registro de asistencia
        $asistencia = Asistencia::create([
            'id_actividad_fk' => $request->id_actividad_fk,
            'id_persona_fk' => $persona->id_persona,
            'ingreso' => Carbon::now(),
            'fecha_asistencia' => Carbon::today(),
            'observacion' => $request->observacion,
            'estado_asistencia' => 'PRESENTE',
            'permiso' => 0,
        ]);

        return response()->json([
            'success' => true,
            'message' => '¡Asistencia registrada exitosamente!',
            'data' => [
                'asistencia' => $asistencia,
                'hora_entrada' => Carbon::parse($asistencia->ingreso)->format('H:i:s'),
                'fecha' => $asistencia->fecha_asistencia,
                'persona' => [
                    'nombre' => $persona->nombre ?? '',
                    'paterno' => $persona->paterno ?? '',
                    'materno' => $persona->materno ?? '',
                ],
                'actividad' => [
                    'id' => $actividad->id,
                    'nombre' => $actividad->nombre_actividad
                ]
            ]
        ], 201);
    }

    /**
     * Registrar entrada (marcado de asistencia)
     * POST /api/asistencia/entrada
     */
    public function registrarEntrada(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_actividad_fk' => 'required|exists:weps_actividad,id',
            'id_persona_fk' => 'required|exists:weps_persona,id_persona',
            'observacion' => 'nullable|string|max:2000',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Verificar si ya existe asistencia para hoy
        $asistenciaExistente = Asistencia::where('id_actividad_fk', $request->id_actividad_fk)
            ->where('id_persona_fk', $request->id_persona_fk)
            ->whereDate('fecha_asistencia', Carbon::today())
            ->first();

        if ($asistenciaExistente) {
            return response()->json([
                'error' => 'Ya existe un registro de asistencia para esta actividad hoy',
                'asistencia' => $asistenciaExistente
            ], 422);
        }

        // Crear registro de asistencia
        $asistencia = Asistencia::create([
            'id_actividad_fk' => $request->id_actividad_fk,
            'id_persona_fk' => $request->id_persona_fk,
            'ingreso' => Carbon::now(),
            'fecha_asistencia' => Carbon::today(),
            'observacion' => $request->observacion,
            'estado_asistencia' => 'PRESENTE',
            'permiso' => 0,
        ]);

        return response()->json([
            'message' => 'Entrada registrada exitosamente',
            'asistencia' => $asistencia,
            'hora_entrada' => Carbon::parse($asistencia->ingreso)->format('H:i:s')
        ], 201);
    }

    /**
     * Registrar salida
     * POST /api/asistencia/salida
     */
    public function registrarSalida(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_asistencia' => 'required|exists:weps_asistencia,id_asistencia',
            'observacion' => 'nullable|string|max:2000',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $asistencia = Asistencia::find($request->id_asistencia);

        if (!$asistencia) {
            return response()->json(['error' => 'Registro de asistencia no encontrado'], 404);
        }

        if ($asistencia->salida) {
            return response()->json([
                'error' => 'La salida ya fue registrada anteriormente',
                'hora_salida' => Carbon::parse($asistencia->salida)->format('H:i:s')
            ], 422);
        }

        $asistencia->salida = Carbon::now();
        if ($request->observacion) {
            $asistencia->observacion = $asistencia->observacion
                ? $asistencia->observacion . ' | ' . $request->observacion
                : $request->observacion;
        }
        $asistencia->save();

        // Calcular duración
        $entrada = Carbon::parse($asistencia->ingreso);
        $salida = Carbon::parse($asistencia->salida);
        $duracion = $entrada->diff($salida);

        return response()->json([
            'message' => 'Salida registrada exitosamente',
            'asistencia' => $asistencia,
            'hora_salida' => $salida->format('H:i:s'),
            'duracion' => sprintf('%02d:%02d:%02d', $duracion->h, $duracion->i, $duracion->s)
        ]);
    }

    /**
     * Obtener mi asistencia de hoy para una actividad
     * GET /api/asistencia/mi-registro-hoy
     */
    public function miRegistroHoy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_actividad_fk' => 'required|exists:weps_actividad,id',
            'id_persona_fk' => 'required|exists:weps_persona,id_persona',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $asistencia = Asistencia::with('actividad')
            ->where('id_actividad_fk', $request->id_actividad_fk)
            ->where('id_persona_fk', $request->id_persona_fk)
            ->whereDate('fecha_asistencia', Carbon::today())
            ->first();

        if (!$asistencia) {
            return response()->json([
                'message' => 'No hay registro de asistencia para hoy',
                'tiene_registro' => false
            ]);
        }

        $duracion = null;
        if ($asistencia->salida) {
            $entrada = Carbon::parse($asistencia->ingreso);
            $salida = Carbon::parse($asistencia->salida);
            $diff = $entrada->diff($salida);
            $duracion = sprintf('%02d:%02d:%02d', $diff->h, $diff->i, $diff->s);
        }

        return response()->json([
            'tiene_registro' => true,
            'asistencia' => $asistencia,
            'hora_entrada' => $asistencia->ingreso ? Carbon::parse($asistencia->ingreso)->format('H:i:s') : null,
            'hora_salida' => $asistencia->salida ? Carbon::parse($asistencia->salida)->format('H:i:s') : null,
            'duracion' => $duracion
        ]);
    }

    /**
     * Obtener historial de asistencias de una persona
     * GET /api/asistencia/historial
     */
    public function historial(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_persona_fk' => 'required|exists:weps_persona,id_persona',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $query = Asistencia::with('actividad')
            ->where('id_persona_fk', $request->id_persona_fk);

        if ($request->fecha_inicio && $request->fecha_fin) {
            $query->whereBetween('fecha_asistencia', [$request->fecha_inicio, $request->fecha_fin]);
        } elseif ($request->fecha_inicio) {
            $query->whereDate('fecha_asistencia', '>=', $request->fecha_inicio);
        }

        $asistencias = $query->orderBy('fecha_asistencia', 'desc')
            ->orderBy('ingreso', 'desc')
            ->paginate($request->get('per_page', 15));

        return response()->json($asistencias);
    }

    /**
     * Obtener asistencias de una actividad
     * GET /api/asistencia/actividad/{id_actividad}
     */
    public function asistenciasPorActividad($id_actividad)
    {
        $actividad = Actividad::find($id_actividad);

        if (!$actividad) {
            return response()->json(['error' => 'Actividad no encontrada'], 404);
        }


        $filtros = request()->all();
        $filtros['id_actividad_fk'] = $id_actividad;

        // return  $filtros;
        $limit = request()->input('size', 15);
        $page = request()->input('page', 1);

        $data = Asistencia::getListaAsistencias($filtros)
            ->paginate($limit, ['*'], 'page', $page);

        $asistencias = $data->items();

        $estadisticas = [
            'total' => $data->total(),
            'con_salida' => Asistencia::where('id_actividad_fk', $id_actividad)
                ->whereNotNull('salida')->count(),
            'sin_salida' => Asistencia::where('id_actividad_fk', $id_actividad)
                ->whereNull('salida')->count(),
            'con_permiso' => Asistencia::where('id_actividad_fk', $id_actividad)
                ->where('permiso', 1)->count(),
        ];

        return response()->json([
            'actividad' => $actividad,
            'asistencias' => $asistencias,
            'estadisticas' => $estadisticas
        ]);
    }

    /**
     * Registrar permiso
     * POST /api/asistencia/permiso
     */
    public function registrarPermiso(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_actividad_fk' => 'required|exists:weps_actividad,id',
            'id_persona_fk' => 'required|exists:weps_persona,id_persona',
            'observacion' => 'required|string|max:2000',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Verificar si ya existe registro para hoy
        $registroExistente = Asistencia::where('id_actividad_fk', $request->id_actividad_fk)
            ->where('id_persona_fk', $request->id_persona_fk)
            ->whereDate('fecha_asistencia', Carbon::today())
            ->first();

        if ($registroExistente) {
            return response()->json([
                'error' => 'Ya existe un registro para esta actividad hoy'
            ], 422);
        }

        $permiso = Asistencia::create([
            'id_actividad_fk' => $request->id_actividad_fk,
            'id_persona_fk' => $request->id_persona_fk,
            'fecha_asistencia' => Carbon::today(),
            'observacion' => $request->observacion,
            'estado_asistencia' => 'PERMISO',
            'permiso' => 1,
        ]);

        return response()->json([
            'message' => 'Permiso registrado exitosamente',
            'permiso' => $permiso
        ], 201);
    }

    /**
     * Obtener estadísticas de asistencia
     * GET /api/asistencia/estadisticas
     */
    public function estadisticas(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_persona_fk' => 'nullable|exists:weps_persona,id_persona',
            'id_actividad_fk' => 'nullable|exists:weps_actividad,id',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $query = Asistencia::query();

        if ($request->id_persona_fk) {
            $query->where('id_persona_fk', $request->id_persona_fk);
        }

        if ($request->id_actividad_fk) {
            $query->where('id_actividad_fk', $request->id_actividad_fk);
        }

        if ($request->fecha_inicio && $request->fecha_fin) {
            $query->whereBetween('fecha_asistencia', [$request->fecha_inicio, $request->fecha_fin]);
        }

        $estadisticas = [
            'total_registros' => (clone $query)->count(),
            'presentes' => (clone $query)->where('permiso', 0)->count(),
            'permisos' => (clone $query)->where('permiso', 1)->count(),
            'con_salida_registrada' => (clone $query)->whereNotNull('salida')->count(),
            'sin_salida_registrada' => (clone $query)->where('permiso', 0)->whereNull('salida')->count(),
        ];

        return response()->json($estadisticas);
    }
}
