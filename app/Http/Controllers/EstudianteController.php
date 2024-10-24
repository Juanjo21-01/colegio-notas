<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Http\Requests\Estudiante\StoreEstudianteRequest;
use App\Http\Requests\Estudiante\UpdateEstudianteRequest;

class EstudianteController extends Controller
{
    // Vista de estudiantes
    public function index()
    {
        $estudiantes = Estudiante::all();
        foreach ($estudiantes as $estudiante) {
            $fechaNacimiento = $estudiante->fecha_nacimiento;
            $fechaNacimiento = explode('-', $fechaNacimiento);
            $fechaNacimiento = $fechaNacimiento[0];
            $fechaActual = date('Y');
            $edad = $fechaActual - $fechaNacimiento;
            $estudiante->edad = $edad;
        }

        return view('estudiante.index', compact('estudiantes'));
    }

    // Crear estudiante
    public function create()
    {
        $estudiante = new Estudiante();
        return view('estudiante.crear', compact('estudiante'));
    }

    // Almacenar estudiante
    public function store(StoreEstudianteRequest $request)
    {
        try {
            // Crear estudiante
            $request->merge(['user_id' => auth()->id()]);
            Estudiante::create($request->all());
            // Redireccionar a la vista de estudiantes
            return redirect()->route('estudiantes.index')->with('success', 'Estudiante creado correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al crear el estudiante');
        }
    }

    // Ver un estudiante
    public function show(string $id)
    {
        $estudiante = Estudiante::find($id);
        return view('estudiante.mostrar', compact('estudiante'));
    }

    // Editar estudiante
    public function edit(string $id)
    {
        $estudiante = Estudiante::find($id);
        return view('estudiante.editar', compact('estudiante'));
    }

    // Actualizar estudiante
    public function update(UpdateEstudianteRequest $request, string $id)
    {
        try {
            // Actualizar estudiante
            $estudiante = Estudiante::find($id);
            $estudiante->update($request->all());
            // Redireccionar a la vista de estudiantes
            return redirect()->route('estudiantes.index')->with('success', 'Estudiante actualizado correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al actualizar el estudiante');
        }
    }

    // Eliminar estudiante
    public function destroy(string $id)
    {
        try {
            // Eliminar estudiante
            Estudiante::destroy($id);
            // Redireccionar a la vista de estudiantes
            return redirect()->route('estudiantes.index')->with('success', 'Estudiante eliminado correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al eliminar el estudiante, verifique que no tenga registros relacionados');
        }
    }

    // Cambiar estado de estudiante
    public function cambiarEstado(string $id)
    {
        try {
            // Cambiar estado de estudiante entre estudiando, retirado, graduado y repitiendo
            $estudiante = Estudiante::find($id);
            if ($estudiante->estado == 'estudiando') {
                $estudiante->estado = 'retirado';
            } elseif ($estudiante->estado == 'retirado') {
                $estudiante->estado = 'graduado';
            } elseif ($estudiante->estado == 'graduado') {
                $estudiante->estado = 'repitiendo';
            } else {
                $estudiante->estado = 'estudiando';
            }
            
            $estudiante->save();
            // Redireccionar a la vista de estudiantes
            return redirect()->route('estudiantes.index')->with('success', 'Estado de estudiante cambiado correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al cambiar el estado del estudiante');
        }
    }
}
