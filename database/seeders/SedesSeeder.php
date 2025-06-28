<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SedesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sedes')->insert([
            [
                'nombre' => 'Almacén',
                'direccion' => 'Av. Industrial 456, Lima',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Local Principal',
                'direccion' => 'Av. Central 123, Lima',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
