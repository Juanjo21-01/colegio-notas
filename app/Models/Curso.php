<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Curso extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'cursos';

    // Campos que se pueden llenar
    protected $fillable = [
        'nombre',
        'estado',
        'user_id',
    ];

    // Relación uno a muchos inversa
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relación uno a muchos
    public function asignacionGradoCursos(): HasMany
    {
        return $this->hasMany(AsignacionGradoCurso::class);
    }
}
