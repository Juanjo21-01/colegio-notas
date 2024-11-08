<?php

namespace App\Http\Controllers;

use App\Models\Grado;
use App\Models\AsignacionGradoCurso;
use App\Models\AsignacionGradoEstudiante;
use App\Models\Calificacion;
use Illuminate\Http\Request;

class GradoController extends Controller
{
    // Vista de grados
    public function index()
    {
        $grados = Grado::all();
        return view('grado.index', compact('grados'));
    }

    // Ver grados
    public function show(string $id, Request $request)
    {
        // Obtener grado
        $grado = Grado::find($id);

        // Obtener la unidad para las calificaciones
        $unidad = $request->get('unidad');
        if (!$unidad) {
            return redirect()->route('grados.index')->with('error', 'Debe seleccionar una unidad');
        }

        // Obtener los cursos del grado
        $cursos = AsignacionGradoCurso::where('grado_id', $id)->get();

        // Obtener los estudiantes del grado
        $estudiantes = AsignacionGradoEstudiante::where('grado_id', $id)->get();

        // Obtener las calificaciones de los estudiantes
        $calificaciones = Calificacion::whereIn('asignacion_grado_curso_id', $cursos->pluck('id'))
        ->where('unidad', $unidad)
        ->get();

        // Agrupar las calificaciones por estudiante y curso
        $calificacionesPorEstudiante = [];
        foreach ($estudiantes as $asignacion) {
            $estudianteId = $asignacion->estudiante_id;
            $calificacionesPorEstudiante[$estudianteId] = [
                'estudiante' => $asignacion->estudiante,
                'calificaciones' => [],
                'totalNotas' => 0,
                'cantidadNotas' => 0,
            ];

            foreach ($cursos as $curso) {
                $calificacion = $calificaciones->where('asignacion_grado_curso_id', $curso->id)
                    ->where('estudiante_id', $estudianteId)
                    ->first();

                $nota = $calificacion ? round($calificacion->nota) : '-';
                $calificacionesPorEstudiante[$estudianteId]['calificaciones'][$curso->curso->nombre] = $nota;

                if (is_numeric($nota)) {
                    $calificacionesPorEstudiante[$estudianteId]['totalNotas'] += $nota;
                    $calificacionesPorEstudiante[$estudianteId]['cantidadNotas']++;
                }
            }

            // Calcular el promedio
            $calificacionesPorEstudiante[$estudianteId]['promedio'] = $calificacionesPorEstudiante[$estudianteId]['cantidadNotas'] > 0
                ? round($calificacionesPorEstudiante[$estudianteId]['totalNotas'] / $calificacionesPorEstudiante[$estudianteId]['cantidadNotas'])
                : '-';
        }

        return view('grado.mostrar', compact('grado', 'unidad', 'cursos', 'calificacionesPorEstudiante'));
    }

    // Cambiar estado de un grado
    public function cambiarEstado(string $id)
    {
        try {
            // Cambiar estado de grado
            $grado = Grado::find($id);

            if ($grado->estado == 'activo') {
                $grado->estado = 'inactivo';
            } else {
                $grado->estado = 'activo';
            }

            $grado->save();

            // Redireccionar a la vista de grados
            return redirect()->route('grados.index')->with('success', 'Estado del grado actualizado correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al cambiar el estado del grado');
        }
    }
}
