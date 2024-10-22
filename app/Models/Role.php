<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'roles';

    // Campos que se pueden llenar
    protected $fillable = ['nombre'];

    protected function nombre(): Attribute
    {
        return new Attribute(
            get: fn ($nombre) => ucfirst($nombre),
            set: fn ($nombre) => strtolower($nombre)
        );
    }

    // Relación uno a muchos
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
