<?php

namespace App\Http\Controllers;

use App\Models\AsignacionGradoCurso;
use App\Models\Grado;
use App\Models\Curso;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Asignacion\StoreGradoCursoRequest;
use App\Http\Requests\Asignacion\UpdateGradoCursoRequest;

class AsignacionGradoCursoController extends Controller
{
    // Vista de asignación de grados y cursos
    public function index(Request $request)
    {
        $grado = $request->grado;

        // si no se envía el parámetro grado, se mostrarán todos los grados y cursos
        $gradosCursos = AsignacionGradoCurso::when($grado, function ($query, $grado) {
            return $query->whereHas('grado', function ($q) use ($grado) {
                $q->where('nombre', $grado);
            });
        })->get();

        return view('grado-curso.index', compact('gradosCursos'));
    }

    // Crear asignación de grado y curso
    public function create()
    {
        $gradoCurso = new AsignacionGradoCurso();
        // traer todos los grados que estén activos
        $grados = Grado::where('estado', 'activo')->get();
        // traer todos los cursos que estén activos
        $cursos = Curso::where('estado', 'activo')->get();
        // traer todos los profesores que estén activos
        $profesores = User::where('estado', 'activo')->whereHas('role', function ($q) {
            $q->where('nombre', 'profesor');
        })->get();
        return view('grado-curso.crear', compact('gradoCurso', 'grados', 'cursos', 'profesores'));
    }

    // Almacenar asignación de grado y curso
    public function store(StoreGradoCursoRequest $request)
    {
        try {
            // Crear asignación de grado y curso
            AsignacionGradoCurso::create($request->all());
            // Redireccionar a la vista de asignación de grados y cursos
            return redirect()->route('grados-cursos.index')->with('success', 'Asignación de grado y curso creada correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al crear la asignación de grado y curso');
        }
    }
    
    // Ver una asignación de grado y curso
    public function show(string $id)
    {
        $gradoCurso = AsignacionGradoCurso::find($id);
        return view('grado-curso.mostrar', compact('gradoCurso'));
    }

    // Editar una asignación de grado y curso
    public function edit(string $id)
    {
        $gradoCurso = AsignacionGradoCurso::find($id);
        // traer todos los grados que estén activos
        $grados = Grado::where('estado', 'activo')->get();
        // traer todos los cursos que estén activos
        $cursos = Curso::where('estado', 'activo')->get();
        // traer todos los profesores que estén activos
        $profesores = User::where('estado', 'activo')->whereHas('role', function ($q) {
            $q->where('nombre', 'profesor');
        })->get();
        return view('grado-curso.editar', compact('gradoCurso', 'grados', 'cursos', 'profesores'));
    }

    // Actualizar asignación de grado y curso
    public function update(UpdateGradoCursoRequest $request, string $id)
    {
        try {
            // Actualizar asignación de grado y curso
            $gradoCurso = AsignacionGradoCurso::find($id);
            $gradoCurso->update($request->all());
            // Redireccionar a la vista de asignación de grados y cursos
            return redirect()->route('grados-cursos.index')->with('success', 'Asignación de grado y curso actualizada correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al actualizar la asignación de grado y curso');
        }
    }

    // Eliminar asignación de grado y curso
    public function destroy(string $id)
    {
        try {
            // Eliminar asignación de grado y curso
            AsignacionGradoCurso::destroy($id);
            // Redireccionar a la vista de asignación de grados y cursos
            return redirect()->route('grados-cursos.index')->with('success', 'Asignación de grado y curso eliminada correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al eliminar la asignación de grado y curso, verifique que no tenga registros relacionados');
        }
    }

    // Cambiar estado de asignación de grado y curso
    public function cambiarEstado(string $id)
    {
        try {
            // Cambiar estado del grado y curso
            $gradoCurso = AsignacionGradoCurso::find($id);

            if ($gradoCurso->estado == 'activo') {
                $gradoCurso->estado = 'inactivo';
            } else {
                $gradoCurso->estado = 'activo';
            }

            $gradoCurso->save();

            // Redireccionar a la vista de usuarios
            return redirect()->route('grados-cursos.index')->with('success', 'Estado del grado y curso actualizado correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al cambiar el estado del grado y curso');
        }
    }
}
