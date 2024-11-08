<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;
use App\Http\Requests\Curso\StoreCursoRequest;
use App\Http\Requests\Curso\UpdateCursoRequest;
use Illuminate\Support\Facades\Auth;

class CursoController extends Controller
{
    // Vista de cursos
    public function index()
    {
        // Validar si el usuario tiene permisos
        if (Auth::user()->role->nombre === 'Profesor') {
            return redirect()->route('dashboard');
        }

        $cursos = Curso::all();
        return view('curso.index', compact('cursos'));
    
    }

    // Crear un nuevo curso
    public function create()
    {
        // Validar si el usuario tiene permisos
        if (Auth::user()->role->nombre === 'Profesor') {
            return redirect()->route('dashboard');
        }

        $curso = new Curso();
        return view('curso.crear', compact('curso'));
    }

    // Almacenar un nuevo curso
    public function store(StoreCursoRequest $request)
    {
        // Validar si el usuario tiene permisos
        if (Auth::user()->role->nombre === 'Profesor') {
            return redirect()->route('dashboard');
        }

        try {
            // Crear curso
            $request->merge(['user_id' => auth()->user()->id]);
            Curso::create($request->all());

            // Redireccionar a la vista de cursos
            return redirect()->route('cursos.index')->with('success', 'Curso creado correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al crear el curso');
        }
    }

    // Mostrar un curso
    public function show(string $id)
    {
        // Validar si el usuario tiene permisos
        if (Auth::user()->role->nombre === 'Profesor') {
            return redirect()->route('dashboard');
        }

        $curso = Curso::find($id);
        return view('curso.mostrar', compact('curso'));
    }

    // Editar un curso
    public function edit(string $id)
    {
        // Validar si el usuario tiene permisos
        if (Auth::user()->role->nombre === 'Profesor') {
            return redirect()->route('dashboard');
        }

        $curso = Curso::find($id);
        return view('curso.editar', compact('curso'));
    }

    // Actualizar un curso
    public function update(UpdateCursoRequest $request, string $id)
    {
        // Validar si el usuario tiene permisos
        if (Auth::user()->role->nombre === 'Profesor') {
            return redirect()->route('dashboard');
        }

        try {
            // Actualizar curso
            $curso = Curso::find($id);
            $curso->update($request->all());
            // Redireccionar a la vista de cursos
            return redirect()->route('cursos.index')->with('success', 'Curso actualizado correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al actualizar el curso');
        }
    }

    // Eliminar un curso
    public function destroy(string $id)
    {
        // Validar si el usuario tiene permisos
        if (Auth::user()->role->nombre !== 'Administrador') {
            return redirect()->route('dashboard');
        }

        try {
            // Eliminar curso
            Curso::destroy($id);
            // Redireccionar a la vista de cursos
            return redirect()->route('cursos.index')->with('success', 'Curso eliminado correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al eliminar el curso, verifique que no tenga registros relacionados');
        }
    }

    // Cambiar el estado de un curso
    public function cambiarEstado(string $id)
    {
        // Validar si el usuario tiene permisos
        if (Auth::user()->role->nombre === 'Profesor') {
            return redirect()->route('dashboard');
        }
        
        try {
            // Cambiar estado de curso
            $curso = Curso::find($id);

            if ($curso->estado == 'activo') {
                $curso->estado = 'inactivo';
            } else {
                $curso->estado = 'activo';
            }

            $curso->save();

            // Redireccionar a la vista de cursos
            return redirect()->route('cursos.index')->with('success', 'Estado del curso actualizado correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al cambiar el estado del curso');
        }
    }
}
