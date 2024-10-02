<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'roles';

    // Campos que se pueden llenar
    protected $fillable = ['nombre'];

    // Relación uno a muchos
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
