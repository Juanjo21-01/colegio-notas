<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear roles
        Role::create(['nombre' => 'administrador']);
        Role::create(['nombre' => 'secretaria']);
        Role::create(['nombre' => 'profesor']);
    }
}
