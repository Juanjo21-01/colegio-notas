<?php

namespace App\Http\Controllers;

use App\Models\AsignacionGradoEstudiante;
use App\Models\Grado;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use App\Http\Requests\Asignacion\StoreGradoEstudianteRequest;
use App\Http\Requests\Asignacion\UpdateGradoEstudianteRequest;

class AsignacionGradoEstudianteController extends Controller
{
    // Vista de asignación de grados y estudiantes
    public function index(Request $request)
    {
        $grado = $request->grado;

        // si no se envía el parámetro grado, se mostrarán todos los grados y estudiantes
        $gradosEstudiantes = AsignacionGradoEstudiante::when($grado, function ($query, $grado) {
            return $query->whereHas('grado', function ($q) use ($grado) {
                $q->where('nombre', $grado);
            });
        })->get();

        return view('grado-estudiante.index', compact('gradosEstudiantes'));
    }

    // Crear asignación de grado y estudiante
    public function create()
    {
        $gradoEstudiante = new AsignacionGradoEstudiante();
        // traer todos los grados que estén activos
        $grados = Grado::where('estado', 'activo')->get();
        // traer todos los estudiantes que tengan el estado estudiando
        $estudiantes = Estudiante::where('estado', 'estudiando')->get();
        
        return view('grado-estudiante.crear', compact('gradoEstudiante', 'grados', 'estudiantes'));
    }

    // Almacenar asignación de grado y estudiante
    public function store(StoreGradoEstudianteRequest $request)
    {
        try {
            // Crear asignación de grado y estudiante
            $request->merge(['user_id' => auth()->user()->id]);
            AsignacionGradoEstudiante::create($request->all());
            // Redireccionar a la vista de asignación de grados y estudiantes
            return redirect()->route('grados-estudiantes.index')->with('success', 'Asignación de grado y estudiante creada correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al crear la asignación de grado y estudiante');
        }
    }
    
    // Ver una asignación de grado y estudiante
    public function show(string $id)
    {
        $gradoEstudiante = AsignacionGradoEstudiante::find($id);
        return view('grado-estudiante.mostrar', compact('gradoEstudiante'));
    }

    // Editar una asignación de grado y estudiante
    public function edit(string $id)
    {
        $gradoEstudiante = AsignacionGradoEstudiante::find($id);
        // traer todos los grados que estén activos
        $grados = Grado::where('estado', 'activo')->get();
        // traer todos los estudiantes que tengan el estado estudiando
        $estudiantes = Estudiante::where('estado', 'estudiando')->get();
        
        return view('grado-estudiante.editar', compact('gradoEstudiante', 'grados', 'estudiantes'));
    }

    // Actualizar una asignación de grado y estudiante
    public function update(UpdateGradoEstudianteRequest $request, string $id)
    {
        try {
            // Actualizar asignación de grado y estudiante
            $gradoEstudiante = AsignacionGradoEstudiante::find($id);
            $gradoEstudiante->update($request->all());
            // Redireccionar a la vista de asignación de grados y estudiantes
            return redirect()->route('grados-estudiantes.index')->with('success', 'Asignación de grado y estudiante actualizada correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al actualizar la asignación de grado y estudiante');
        }
    }

    // Eliminar una asignación de grado y estudiante
    public function destroy(string $id)
    {
        try {
            // Eliminar asignación de grado y estudiante
            AsignacionGradoEstudiante::destroy($id);
            // Redireccionar a la vista de asignación de grados y estudiantes
            return redirect()->route('grados-estudiantes.index')->with('success', 'Asignación de grado y estudiante eliminada correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al eliminar la asignación de grado y estudiante');
        }
    }

    // Cambiar estado de una asignación de grado y estudiante
    public function cambiarEstado(string $id)
    {
        try {
            // Cambiar estado del grado y estudiante
            $gradoEstudiante = AsignacionGradoEstudiante::find($id);

            if ($gradoEstudiante->estado == 'activo') {
                $gradoEstudiante->estado = 'inactivo';
            } else {
                $gradoEstudiante->estado = 'activo';
            }

            $gradoEstudiante->save();

            // Redireccionar a la vista de usuarios
            return redirect()->route('grados-estudiantes.index')->with('success', 'Estado del grado y estudiante actualizado correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al cambiar el estado del grado y estudiante');
        }
    }
}
