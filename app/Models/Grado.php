<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grado extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'grados';

    // Campos que se pueden llenar
    protected $fillable = [
        'nombre',
        'seccion',
        'estado',
    ];

    // Relación uno a muchos
    public function asignacionGradoCursos(): HasMany
    {
        return $this->hasMany(AsignacionGradoCurso::class);
    }
    
    public function asignacionGradoEstudiantes(): HasMany
    {
        return $this->hasMany(AsignacionGradoEstudiante::class);
    }
}
