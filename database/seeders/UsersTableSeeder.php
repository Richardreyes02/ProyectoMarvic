<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Richard Reyes',
                'email' => 'richard@hotmail.com',
                'password' => Hash::make('password123'),
                'dni_usuario' => '70549384',
                'genero_usuario' => 'masculino',
                'telefono_usuario' => '956148768',
                'rol_usuario' => 'admin',
                'cargo' => 'Administrador',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Maria Lopez',
                'email' => 'maria@gmail.com',
                'password' => Hash::make('password123'),
                'dni_usuario' => '87654321',
                'genero_usuario' => 'femenino',
                'telefono_usuario' => '955556780',
                'rol_usuario' => 'user',
                'cargo' => 'Encargado de Despacho',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Carlos Gomez',
                'email' => 'carlos@hotmail.com',
                'password' => Hash::make('password123'),
                'dni_usuario' => '11223344',
                'genero_usuario' => 'masculino',
                'telefono_usuario' => '974555901',
                'rol_usuario' => 'user',
                'cargo' => 'Almacenero de Materiales',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ana Torres',
                'email' => 'anitat@gmail.com',
                'password' => Hash::make('password123'),
                'dni_usuario' => '44332211',
                'genero_usuario' => 'femenino',
                'telefono_usuario' => '968547345',
                'rol_usuario' => 'user',
                'cargo' => 'Responsable de Compras',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Luis Martinez',
                'email' => 'luchom@hotmail.com',
                'password' => Hash::make('password123'),
                'dni_usuario' => '55667788',
                'genero_usuario' => 'masculino',
                'telefono_usuario' => '988555789',
                'rol_usuario' => 'user',
                'cargo' => 'Almacenero de Productos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
