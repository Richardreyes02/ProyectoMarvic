<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('materials')->insert([
            [
                'nombre' => 'Cuero napa',
                'descripcion' => 'Cuero napa suave de alta calidad para botines de mujer',
                'stock' => 800,
                'unidad_medida' => 'm2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Forro textil transpirable',
                'descripcion' => 'Forro interior transpirable para sandalias y botines',
                'stock' => 600,
                'unidad_medida' => 'm2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Suela de PVC flexible',
                'descripcion' => 'Suela liviana de PVC para sandalias femeninas',
                'stock' => 1000,
                'unidad_medida' => 'pares',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Tacón de ABS moldeado',
                'descripcion' => 'Tacones de ABS para botines de mujer, 5 cm',
                'stock' => 300,
                'unidad_medida' => 'pares',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Hebilla metálica dorada',
                'descripcion' => 'Hebillas decorativas para sandalias femeninas',
                'stock' => 500,
                'unidad_medida' => 'unidades',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Elástico plano negro',
                'descripcion' => 'Elástico para ajuste en botines y sandalias',
                'stock' => 250,
                'unidad_medida' => 'metros',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Plantilla de látex forrada',
                'descripcion' => 'Plantillas confortables forradas para botines de mujer',
                'stock' => 700,
                'unidad_medida' => 'pares',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
