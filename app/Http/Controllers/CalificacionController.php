<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;
use App\Models\AsignacionGradoCurso;
use App\Models\AsignacionGradoEstudiante;
use Illuminate\Http\Request;
use App\Http\Requests\Calificaciones\StoreCalificacionesRequest;
use App\Http\Requests\Calificaciones\UpdateCalificacionesRequest;

class CalificacionController extends Controller
{
    // Vista de calificaciones
    public function index(Request $request)
    {
        $grado = $request->grado;
        $usuarioRol = auth()->user()->role->nombre;
        $usuario = auth()->user();

        // Verificar si el usuario es administrador o secretaria
        if ($usuarioRol === 'Administrador' || $usuarioRol === 'Secretaria') {
            $gradosCursos = AsignacionGradoCurso::when($grado, function ($query, $grado) {
                return $query->whereHas('grado', function ($q) use ($grado) {
                    $q->where('nombre', $grado);
                });
            })->get();
        }
        // Verificar si el usuario es profesor
        elseif ($usuarioRol === 'Profesor'){
            $gradosCursos = AsignacionGradoCurso::where('user_id', $usuario->id)
            ->when($grado, function ($query, $grado) {
                return $query->whereHas('grado', function ($q) use ($grado) {
                    $q->where('nombre', $grado);
                });
            })->get();
        }

        return view('calificaciones.index', compact('gradosCursos', 'grado'));
    }

    // Crear calificaciones
    public function create(Request $request)
    {
        $gradoCursoId = $request->gradoCurso;

        if ($gradoCursoId === null) {
            return redirect()->route('calificaciones.index')->with('error', 'Debe seleccionar un grado y curso para ingresar las calificaciones.');
        }

        // Buscar la asignación de grado y curso
        $gradoCurso = AsignacionGradoCurso::find($gradoCursoId);
        // Traer todos los estudiantes que estén asignados al grado
        $estudiantes = AsignacionGradoEstudiante::where('grado_id', $gradoCurso->grado_id)->get();
        return view('calificaciones.crear', compact('gradoCurso', 'estudiantes'));
    }

    // Almacenar las calificaciones
    public function store(StoreCalificacionesRequest $request)
    {
        // Recibir los datos del formulario
        $unidad = $request->unidad;
        $gradoCursoId = $request->grado_curso_id;

        // Recorrer los estudiantes y guardar las calificaciones
        foreach ($request->calificaciones as $calificacion) {
            // Verificar si ya existe una calificación para este estudiante, grado y unidad
            $calificacionExistente = Calificacion::where('estudiante_id', $calificacion['estudiante_id'])
                ->where('asignacion_grado_curso_id', $gradoCursoId)
                ->where('unidad', $unidad)
                ->first();

                if ($calificacionExistente) {
                return redirect()->route('calificaciones.index')->with('error', 'Ya existe una calificación para el estudiante: ' . $calificacionExistente->estudiante->apellidos . ', '. $calificacionExistente->estudiante->nombres . ' en la unidad ' . $unidad . '.');
            }

            try {
                Calificacion::create([
                'estudiante_id' => $calificacion['estudiante_id'],
                'asignacion_grado_curso_id' => $gradoCursoId,
                'user_id' => auth()->user()->id,
                'nota' => $calificacion['nota'],
                'unidad' => $unidad,
            ]);
            } catch (\Exception $e) {
                return back()->with('error', 'Ocurrió un error al guardar las calificaciones, por favor intente de nuevo.');
            }
        }

        $gradoCurso = AsignacionGradoCurso::find($gradoCursoId);
        return redirect()->route('calificaciones.index', ['grado' => $gradoCurso->grado->nombre])->with('success', 'Calificaciones de: ' . $gradoCurso->grado->nombre . ' "'.$gradoCurso->grado->seccion.'" - ' . $gradoCurso->curso->nombre . ' - Unidad ' . $unidad . ' guardadas correctamente.');
    }

    // Mostrar calificaciones
    public function show(string $id)
    {
        // Buscar las calificaciones del grado y curso
        $gradoCurso = AsignacionGradoCurso::find($id);
        // Buscar las calificaciones
        $calificaciones = Calificacion::where('asignacion_grado_curso_id', $id)->get();

        // Arreglo para almacenar las calificaciones por estudiante
        $calificacionesPorEstudiante = [];

        // Recorrer las calificaciones y agruparlas por estudiante
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

        return view('calificaciones.mostrar', compact('calificacionesPorEstudiante', 'gradoCurso'));
    }

    // Editar calificaciones
    public function edit(string $id)
    {
        // Buscar las calificaciones del grado y curso
        $gradoCurso = AsignacionGradoCurso::find($id);

        // Buscar las calificaciones
        $calificaciones = Calificacion::where('asignacion_grado_curso_id', $id)->get();

        // Arreglo para almacenar las calificaciones por estudiante
        $calificacionesPorEstudiante = [];

        // Recorrer las calificaciones y agruparlas por estudiante
        foreach ($calificaciones as $calificacion) {
            $estudianteId = $calificacion->estudiante_id;

            if (!isset($calificacionesPorEstudiante[$estudianteId])) {
                $calificacionesPorEstudiante[$estudianteId] = [
                    'id' => $calificacion->estudiante->id,
                    'codigo' => $calificacion->estudiante->codigo_personal,
                    'estudiante' => $calificacion->estudiante->apellidos . ', ' . $calificacion->estudiante->nombres,
                    'calificaciones' => [
                        'I' => 0,  // Asumimos 0 si no hay nota creada
                        'II' => 0,
                        'III' => 0,
                        'IV' => 0,
                    ],
                ];
            }

            // Asignar la nota a la unidad correspondiente
            $calificacionesPorEstudiante[$estudianteId]['calificaciones'][$calificacion->unidad] = round($calificacion->nota);
        }

        // Retornar la vista de edición de calificaciones
        return view('calificaciones.editar', compact('calificacionesPorEstudiante', 'gradoCurso'));
    }

    // Actualizar calificaciones
    public function update(UpdateCalificacionesRequest $request)
    {
        // Recibir los datos del formulario
        $unidad = $request->unidad;
        $gradoCursoId = $request->grado_curso_id;

        // Recorrer los estudiantes y actualizar las calificaciones
        foreach ($request->calificaciones as $calificacion) {
            try {
                // Buscar la calificación existente
                $calificacionExistente = Calificacion::where('estudiante_id', $calificacion['estudiante_id'])
                    ->where('asignacion_grado_curso_id', $gradoCursoId)
                    ->where('unidad', $unidad)
                    ->first();
                    if ($calificacionExistente) {
                    // Actualizar la calificación existente
                    $calificacionExistente->update([
                        'nota' => $calificacion['nota'],
                        'user_id' => auth()->user()->id,
                    ]);
                } else {
                    // Si no existe, crear una nueva calificación
                    Calificacion::create([
                        'estudiante_id' => $calificacion['estudiante_id'],
                        'asignacion_grado_curso_id' => $gradoCursoId,
                        'user_id' => auth()->user()->id,
                        'nota' => $calificacion['nota'],
                        'unidad' => $unidad,
                    ]);
                }
            } catch (\Exception $e) {
                return back()->with('error', 'Ocurrió un error al actualizar las calificaciones, por favor intente de nuevo.');
            }
        }

        $gradoCurso = AsignacionGradoCurso::find($gradoCursoId);
        return redirect()->route('calificaciones.index', ['grado' => $gradoCurso->grado->nombre])->with('success', 'Calificaciones de: ' . $gradoCurso->grado->nombre . ' "'.$gradoCurso->grado->seccion.'" - ' . $gradoCurso->curso->nombre . ' - Unidad ' . $unidad . ' actualizadas correctamente.');
    }

}
