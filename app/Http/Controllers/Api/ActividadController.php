<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin\Actividad;
use App\Models\Admin\Asistencia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ActividadController extends Controller
{
    /**
     * Constructor - requiere autenticación para todos los métodos
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Listar actividades disponibles
     * GET /api/actividades
     */
    public function index(Request $request)
    {
        $query = Actividad::query();

        // Filtrar por fecha si se proporciona
        if ($request->has('fecha')) {
            $query->whereDate('fecha_actividad', $request->fecha);
        }

        // Solo actividades futuras o de hoy
        if ($request->has('activas') && $request->activas) {
            $query->whereDate('fecha_actividad', '>=', Carbon::today());
        }

        $actividades = $query->orderBy('fecha_actividad', 'desc')
            ->paginate($request->get('per_page', 15));

        return response()->json($actividades);
    }

    /**
     * Obtener detalle de una actividad
     * GET /api/actividades/{id}
     */
    public function show($id)
    {
        $actividad = Actividad::with(['asistencias' => function($query) {
            $query->select('id_asistencia', 'id_actividad_fk', 'id_persona_fk', 'ingreso', 'salida', 'estado_asistencia', 'permiso');
        }])->find($id);

        if (!$actividad) {
            return response()->json(['error' => 'Actividad no encontrada'], 404);
        }

        return response()->json([
            'actividad' => $actividad,
            'total_asistencias' => $actividad->asistencias->count(),
            'con_permiso' => $actividad->asistencias->where('permiso', 1)->count(),
        ]);
    }

    /**
     * Obtener actividades de hoy
     * GET /api/actividades/hoy
     */
    public function actividadesHoy()
    {
        $actividades = Actividad::whereDate('fecha_actividad', Carbon::today())
            ->orderBy('nombre_actividad')
            ->get();

        return response()->json([
            'fecha' => Carbon::today()->format('Y-m-d'),
            'actividades' => $actividades,
            'total' => $actividades->count()
        ]);
    }

    /**
     * Crear nueva actividad
     * POST /api/actividades
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Actividad::$rules, Actividad::$messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $actividad = Actividad::create($validator->validated());

        return response()->json([
            'message' => 'Actividad creada exitosamente',
            'actividad' => $actividad
        ], 201);
    }

    /**
     * Actualizar actividad
     * PUT/PATCH /api/actividades/{id}
     */
    public function update(Request $request, $id)
    {
        $actividad = Actividad::find($id);

        if (!$actividad) {
            return response()->json(['error' => 'Actividad no encontrada'], 404);
        }

        $validator = Validator::make($request->all(), Actividad::$rules, Actividad::$messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $actividad->update($validator->validated());

        return response()->json([
            'message' => 'Actividad actualizada exitosamente',
            'actividad' => $actividad
        ]);
    }

    /**
     * Eliminar actividad
     * DELETE /api/actividades/{id}
     */
    public function destroy($id)
    {
        $actividad = Actividad::find($id);

        if (!$actividad) {
            return response()->json(['error' => 'Actividad no encontrada'], 404);
        }

        // Verificar si tiene asistencias registradas
        if ($actividad->asistencias()->count() > 0) {
            return response()->json([
                'error' => 'No se puede eliminar una actividad con asistencias registradas'
            ], 422);
        }

        $actividad->delete();

        return response()->json(['message' => 'Actividad eliminada exitosamente']);
    }
}
