<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\NotaIngresoProducto;

class NotaIngresoProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {

            // Nota 1
            $nota1 = NotaIngresoProducto::create([
                'codigo' => 'NIP001',
                'fecha' => now(),
                'tipo_documento' => 'Factura',
                'numero_documento' => 'F001-000111',
                'usuario_id' => 2,
                'sede_id' => 1,
                'observaciones' => 'Ingreso de productos terminados',
                'estado' => 'confirmado',
            ]);

            $nota1->detalles()->createMany([
                [
                    'product_id' => 1,
                    'cantidad' => 12,
                ],
                [
                    'product_id' => 2,
                    'cantidad' => 6,
                ]
            ]);

            // Nota 2
            $nota2 = NotaIngresoProducto::create([
                'codigo' => 'NIP002',
                'fecha' => now()->subDays(1),
                'tipo_documento' => 'Boleta',
                'numero_documento' => 'B001-000222',
                'usuario_id' => 3,
                'sede_id' => 2,
                'observaciones' => 'Ingreso desde producción especial',
                'estado' => 'pendiente',
            ]);

            $nota2->detalles()->createMany([
                [
                    'product_id' => 3,
                    'cantidad' => 24,
                ]
            ]);
        });
    }
}
