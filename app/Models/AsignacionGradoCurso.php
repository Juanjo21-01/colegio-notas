<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AsignacionGradoCurso extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'asignacion_grado_cursos';

    // Campos que se pueden llenar
    protected $fillable = [
        'grado_id',
        'curso_id',
        'estado',
        'user_id',
    ];

    // Relación uno a muchos inversa
    public function grado(): BelongsTo
    {
        return $this->belongsTo(Grado::class);
    }

    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relación uno a muchos
    public function calificaciones(): HasMany
    {
        return $this->hasMany(Calificacion::class);
    }
}
