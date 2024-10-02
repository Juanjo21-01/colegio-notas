<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Nombre de la tabla
    protected $table = 'users';

    // Campos que se pueden llenar
    protected $fillable = [
        'nombres',
        'apellidos',
        'email',
        'password',
        'dpi',
        'telefono',
        'estado',
        'role_id',
    ];

    // Atributos ocultos
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Atributos que se deben convertir a tipos nativos
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relación uno a muchos inversa
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    // Relación uno a muchos
    public function estudiantes(): HasMany
    {
        return $this->hasMany(Estudiante::class);
    }

    public function cursos(): HasMany
    {
        return $this->hasMany(Curso::class);
    }

    public function calificaciones(): HasMany
    {
        return $this->hasMany(Calificacion::class);
    }

    public function asignacionGradoEstudiantes(): HasMany
    {
        return $this->hasMany(AsignacionGradoEstudiante::class);
    }

    public function asignacionGradoCursos(): HasMany
    {
        return $this->hasMany(AsignacionGradoCurso::class);
    }
}
