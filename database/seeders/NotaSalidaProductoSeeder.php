<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NotaSalidaProducto;
use Illuminate\Support\Facades\DB;

class NotaSalidaProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            // Nota 1
            $nota1 = NotaSalidaProducto::create([
                'codigo' => 'NSP001',
                'fecha' => now(),
                'sede_id' => 1,
                'tipo_documento' => 'Guia de Remisión',
                'numero_documento' => 'GR001-901',
                'usuario_id' => 2,
                'observaciones' => 'Primera nota de salida de productos',
                'estado' => 'confirmado',
            ]);

            $nota1->detalles()->createMany([
                [
                    'producto_id' => 1,
                    'cantidad' => 12.0,
                ],
                [
                    'producto_id' => 2,
                    'cantidad' => 24.0,
                ],
            ]);

            // Nota 2
            $nota2 = NotaSalidaProducto::create([
                'codigo' => 'NSP002',
                'fecha' => now()->subDay(),
                'sede_id' => 1,
                'tipo_documento' => 'Guia de Remisión',
                'numero_documento' => 'GR001-002',
                'usuario_id' => 3,
                'observaciones' => 'Segunda nota de salida de productos',
                'estado' => 'pendiente',
            ]);

            $nota2->detalles()->createMany([
                [
                    'producto_id' => 3,
                    'cantidad' => 24.0,
                ],
                [
                    'producto_id' => 1,
                    'cantidad' => 12.0,
                ],
            ]);
        });
    }
}
