<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AsignacionGradoEstudiante extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'asignacion_grado_estudiantes';

    // Campos que se pueden llenar
    protected $fillable = [
        'grado_id',
        'estudiante_id',
        'estado',
        'user_id',
    ];

    // Relación uno a muchos inversa
    public function grado(): BelongsTo
    {
        return $this->belongsTo(Grado::class);
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
