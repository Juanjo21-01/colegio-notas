<?php

namespace App\Http\Controllers;

use App\Models\Grado;
use App\Models\AsignacionGradoEstudiante;
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
    public function show(Grado $grado)
    {
        //
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
