<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NotaSalidaMaterial;
use App\Models\DetalleNotaSalidaMaterial;
use App\Models\User;
use App\Models\Sede;
use App\Models\Material;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;

class NotaSalidaMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            // Nota 1
            $nota1 = NotaSalidaMaterial::create([
                'codigo' => 'NSM001',
                'fecha' => now(),
                'sede_id' => 1,
                'tipo_documento' => 'Orden de Producción',
                'numero_documento' => 'OP-001',
                'usuario_id' => 2,
                'observaciones' => 'Primera nota de salida',
                'estado' => 'confirmado',
            ]);

            $nota1->detalles()->createMany([
                [
                    'material_id' => 1,
                    'cantidad' => 5,
                    'unidad_medida' => Material::find(1)?->unidad_medida ?? 'unid',
                ],
                [
                    'material_id' => 2,
                    'cantidad' => 4,
                    'unidad_medida' => Material::find(2)?->unidad_medida ?? 'unid',
                ],
            ]);

            // Nota 2
            $nota2 = NotaSalidaMaterial::create([
                'codigo' => 'NSM002',
                'fecha' => now()->subDay(),
                'sede_id' => 2,
                'tipo_documento' => 'Orden de Producción',
                'numero_documento' => 'OP-002',
                'usuario_id' => 3,
                'observaciones' => 'Segunda nota de salida',
                'estado' => 'pendiente',
            ]);

            $nota2->detalles()->createMany([
                [
                    'material_id' => 3,
                    'cantidad' => 12,
                    'unidad_medida' => Material::find(3)?->unidad_medida ?? 'unid',
                ],
            ]);
        });
    }
}
