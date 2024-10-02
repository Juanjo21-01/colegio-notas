<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Calificacion extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'calificaciones';

    // Campos que se pueden llenar
    protected $fillable = [
        'asignacion_grado_curso_id',
        'estudiante_id',
        'nota',
        'unidad',
        'estado',
        'user_id',
    ];

    // Relación uno a muchos inversa
    public function asignacionGradoCurso(): BelongsTo
    {
        return $this->belongsTo(AsignacionGradoCurso::class);
    }

    public function estudiante(): BelongsTo
    {
        return $this->belongsTo(Estudiante::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
