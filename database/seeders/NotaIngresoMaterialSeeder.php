<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\NotaIngresoMaterial;


class NotaIngresoMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {

            // Nota 1
            $nota1 = NotaIngresoMaterial::create([
                'codigo' => 'NIM001',
                'fecha' => now(),
                'proveedor_id' => 1,
                'tipo_documento' => 'Factura',
                'numero_documento' => 'F001-000123',
                'usuario_id' => 2,
                'sede_id' => 1,
                'observaciones' => 'Primera nota de ingreso',
                'estado' => 'confirmado'
            ]);

            $nota1->detalles()->createMany([
                [
                    'material_id' => 1,
                    'cantidad' => 10,
                    'unidad_medida' => 'kg',
                    'costo_unitario' => 15.50,
                    'subtotal' => 155.00,
                ],
                [
                    'material_id' => 2,
                    'cantidad' => 5,
                    'unidad_medida' => 'lt',
                    'costo_unitario' => 22.00,
                    'subtotal' => 110.00,
                ]
            ]);

            // Nota 2
            $nota2 = NotaIngresoMaterial::create([
                'codigo' => 'NIM002',
                'fecha' => now()->subDay(),
                'proveedor_id' => 2,
                'tipo_documento' => 'Boleta',
                'numero_documento' => 'B002-000456',
                'usuario_id' => 3,
                'sede_id' => 2,
                'observaciones' => 'Segunda nota de ingreso',
                'estado' => 'pendiente'
            ]);

            $nota2->detalles()->createMany([
                [
                    'material_id' => 3,
                    'cantidad' => 20,
                    'unidad_medida' => 'unid',
                    'costo_unitario' => 7.00,
                    'subtotal' => 140.00,
                ]
            ]);
        });
    }
}
