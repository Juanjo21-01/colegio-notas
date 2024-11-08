<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    // vista de roles
    public function index()
    {
        // Validar si el usuario tiene permisos
        if (Auth::user()->role->nombre !== 'Administrador') {
            return redirect()->route('dashboard');
        }

        $roles = Role::all();
        return view('rol.index', compact('roles'));
    }
}
