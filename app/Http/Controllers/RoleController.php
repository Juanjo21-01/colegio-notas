<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // vista de roles
    public function index()
    {
        $roles = Role::all();
        return view('rol.index', compact('roles'));
    }
}
