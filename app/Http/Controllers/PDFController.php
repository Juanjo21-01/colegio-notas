<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;
use App\Models\AsignacionGradoCurso;
use App\Models\AsignacionGradoEstudiante;
use App\Models\Grado;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;

class PDFController extends Controller
{
    // Calificaciones por grado y curso
    public function calificacionesPorCurso($id)
    {
        // Buscamos la asignación de grado y curso
        $gradoCurso = AsignacionGradoCurso::find($id);
        // Buscamos las calificaciones de los estudiantes
        $calificaciones = Calificacion::where('asignacion_grado_curso_id', $id)->get();
        
        // Arreglo para almacenar las calificaciones por estudiante
        $calificacionesPorEstudiante = [];

        // Recorremos las calificaciones para agruparlas por estudiante
        foreach ($calificaciones as $calificacion) {
            $estudianteId = $calificacion->estudiante_id;

            if (!isset($calificacionesPorEstudiante[$estudianteId])) {
                $calificacionesPorEstudiante[$estudianteId] = [
                    'id' => $calificacion->estudiante->id,
                    'codigo' => $calificacion->estudiante->codigo_personal,
                    'estudiante' => $calificacion->estudiante->apellidos. ', '. $calificacion->estudiante->nombres,
                    'calificaciones' => [
                        'I' => 0,
                        'II' => 0,
                        'III' => 0,
                        'IV' => 0,
                    ],
                    'totalNotas' => 0,
                    'cantidadNotas' => 0,
                ];
            }

            // Asignar la nota a la unidad correspondiente
            $calificacionesPorEstudiante[$estudianteId]['calificaciones'][$calificacion->unidad] = round($calificacion->nota);
            $calificacionesPorEstudiante[$estudianteId]['totalNotas'] += round($calificacion->nota);
            $calificacionesPorEstudiante[$estudianteId]['cantidadNotas']++;
        }

        // Calcular promedios
        foreach ($calificacionesPorEstudiante as &$estudiante) {
            $estudiante['promedio'] = $estudiante['cantidadNotas'] > 0 ? round($estudiante['totalNotas'] / $estudiante['cantidadNotas']) : 0;
        }

        // Nombre del archivo PDF
        $pdfNombre = $gradoCurso->grado->nombre. ' '. $gradoCurso->grado->seccion. ' - '. $gradoCurso->curso->nombre. '.pdf';

        // Generamos el PDF
        $pdf = PDF::loadView('pdf.calificacionCurso', compact('gradoCurso', 'calificacionesPorEstudiante', 'pdfNombre'));

        // Retornamos el PDF
        return $pdf->stream($pdfNombre);
    }

    // Calificaciones por grados y todos los cursos y estudiantes de un grado
    public function calificacionesPorGrado(string $id, Request $request)
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
        
        // Nombre del archivo PDF
        $pdfNombre = 'Calificaciones '. $grado->nombre. ' '. $grado->seccion. ' - '. $unidad. ' unidad.pdf';

        // Generamos el PDF
        $pdf = PDF::loadView('pdf.calificacionGrado', compact('grado', 'unidad', 'cursos', 'calificacionesPorEstudiante', 'pdfNombre'))->setPaper('legal', 'landscape');

        // Retornamos el PDF
        return $pdf->stream($pdfNombre);
    }

    // Calificaciones por estudiante y todos los cursos de un estudiante en un grado
    public function calificacionesPorEstudiante($idGrado, $idEstudiante)
    {
        // Buscar el grado y el estudiante
        $grado = Grado::find($idGrado);
        $estudiante = Estudiante::find($idEstudiante);

        // Obtener todos los cursos del grado
        $cursos = AsignacionGradoCurso::where('grado_id', $idGrado)->get();

        // Obtener las calificaciones del estudiante por curso
        $calificaciones = Calificacion::where('estudiante_id', $idEstudiante)
            ->whereIn('asignacion_grado_curso_id', $cursos->pluck('id'))
            ->get();

        // Agrupar las calificaciones por curso
        $calificacionesPorCurso = [];

        // Recorrer los cursos y asignar las calificaciones
        foreach ($cursos as $curso) {
            $calificacionesPorCurso[$curso->curso->nombre] = [
                'curso' => $curso->curso->nombre,
                'calificaciones' => [
                    'I' => is_numeric($calI = $calificaciones->where('asignacion_grado_curso_id', $curso->id)->where('unidad', 'I')->first()->nota ?? '-') ? floatval($calI) : '-',
                    'II' => is_numeric($calII = $calificaciones->where('asignacion_grado_curso_id', $curso->id)->where('unidad', 'II')->first()->nota ?? '-') ? floatval($calII) : '-',
                    'III' => is_numeric($calIII = $calificaciones->where('asignacion_grado_curso_id', $curso->id)->where('unidad', 'III')->first()->nota ?? '-') ? floatval($calIII) : '-',
                    'IV' => is_numeric($calIV = $calificaciones->where('asignacion_grado_curso_id', $curso->id)->where('unidad', 'IV')->first()->nota ?? '-') ? floatval($calIV) : '-',
                ],
                'totalNotas' => $calificaciones->where('asignacion_grado_curso_id', $curso->id)->sum('nota'),
                'cantidadNotas' => $calificaciones->where('asignacion_grado_curso_id', $curso->id)->count(),
            ];
        }

        // Calcular promedios
        foreach ($calificacionesPorCurso as &$curso) {
            $curso['promedio'] = $curso['cantidadNotas'] > 0 ? round($curso['totalNotas'] / $curso['cantidadNotas']) : 0;
        }

        // total promedio
        $totalPromedio = 0;
        $totalCursos = count($calificacionesPorCurso);

        // Nombre del archivo PDF
        $pdfNombre = 'Calificaciones '. $grado->nombre . ' ' .$grado->seccion . ' - ' . $estudiante->nombres . ' ' . $estudiante->apellidos . '.pdf';

        // Generar el PDF
        $pdf = PDF::loadView('pdf.calificacionEstudiante', compact('grado', 'estudiante', 'calificacionesPorCurso', 'totalPromedio', 'totalCursos', 'pdfNombre'));

        // Retornar el PDF
        return $pdf->stream($pdfNombre);
    }
}
