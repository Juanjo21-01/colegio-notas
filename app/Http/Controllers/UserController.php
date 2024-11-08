<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\Usuario\StoreUsuarioRequest;
use App\Http\Requests\Usuario\UpdateUsuarioRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Vista de usuarios
    public function index(Request $request)
    {
        // Validar si el usuario tiene permisos
        if (Auth::user()->role->nombre !== 'Administrador') {
            return redirect()->route('dashboard');
        }

        $rol = $request->rol;
        // si no se envía el parámetro rol, se mostrarán todos los usuarios
        $usuarios = User::when($rol, function ($query, $rol) {
            return $query->whereHas('role', function ($q) use ($rol) {
                $q->where('nombre', $rol);
            });
        })->get();
        return view('usuario.index', compact('usuarios'));
    }

    // Crear usuario
    public function create()
    {
        // Validar si el usuario tiene permisos
        if (Auth::user()->role->nombre !== 'Administrador') {
            return redirect()->route('dashboard');
        }

        $usuario = new User();
        $roles = Role::all()->except(1);
        return view('usuario.crear', compact('usuario', 'roles'));
    }

    // Almacenar usuario
    public function store(StoreUsuarioRequest $request)
    {
        // Validar si el usuario tiene permisos
        if (Auth::user()->role->nombre !== 'Administrador') {
            return redirect()->route('dashboard');
        }
        
        try {
            // Crear usuario
            User::create($request->all());
            // Redireccionar a la vista de usuarios
            return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al crear el usuario');
        }
    }

    // Ver un usuario
    public function show(string $id)
    {
        // Validar si el usuario tiene permisos
        if (Auth::user()->role->nombre !== 'Administrador') {
            return redirect()->route('dashboard');
        }

        $usuario = User::find($id);
        return view('usuario.mostrar', compact('usuario'));
    }

    // Editar usuario
    public function edit(string $id)
    {
        // Validar si el usuario tiene permisos
        if (Auth::user()->role->nombre !== 'Administrador') {
            return redirect()->route('dashboard');
        }

        $usuario = User::find($id);
        $roles = Role::all()->except(1);
        return view('usuario.editar', compact('usuario', 'roles'));
    }
    
    // Actualizar usuario
    public function update(UpdateUsuarioRequest $request, string $id)
    {
        // Validar si el usuario tiene permisos
        if (Auth::user()->role->nombre !== 'Administrador') {
            return redirect()->route('dashboard');
        }

        try {
            // Actualizar usuario
            $usuario = User::find($id);
            $usuario->update($request->all());
            // Redireccionar a la vista de usuarios
            return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al actualizar el usuario');
        }
    }

    // Eliminar usuario
    public function destroy(string $id)
    {
        // Validar si el usuario tiene permisos
        if (Auth::user()->role->nombre !== 'Administrador') {
            return redirect()->route('dashboard');
        }

        try {
            // Eliminar usuario
            User::destroy($id);
            // Redireccionar a la vista de usuarios
            return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al eliminar el usuario, verifique que no tenga registros relacionados');
        }
    }

    // Cambiar estado de usuario
    public function cambiarEstado(string $id)
    {
        // Validar si el usuario tiene permisos
        if (Auth::user()->role->nombre !== 'Administrador') {
            return redirect()->route('dashboard');
        }

        try {
            // Cambiar estado de usuario
            $usuario = User::find($id);

            if ($usuario->estado == 'activo') {
                $usuario->estado = 'inactivo';
            } else {
                $usuario->estado = 'activo';
            }

            $usuario->save();

            // Redireccionar a la vista de usuarios
            return redirect()->route('usuarios.index')->with('success', 'Estado de usuario actualizado correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al cambiar el estado del usuario');
        }
    }
}
