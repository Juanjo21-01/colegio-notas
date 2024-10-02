<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estudiante extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'estudiantes';

    // Campos que se pueden llenar
    protected $fillable = [
        'nombres',
        'apellidos',
        'fecha_nacimiento',
        'codigo_personal',
        'genero',
        'estado',
        'user_id',
    ];

    // Relación uno a muchos inversa
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relación uno a muchos
    public function calificaciones(): HasMany
    {
        return $this->hasMany(Calificacion::class);
    }

    public function asignacionGradoEstudiante(): HasMany
    {
        return $this->hasMany(AsignacionGradoEstudiante::class);
    }
}
