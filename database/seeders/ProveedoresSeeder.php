<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('proveedores')->insert([
            [
                'ruc' => '20123456789',
                'razon_social' => 'Inversiones Santa Lucia SAC',
                'direccion' => 'Av. Arequipa 1234, Lima',
                'correo' => 'contacto@santalucia.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ruc' => '20456789123',
                'razon_social' => 'Servicios Industriales Rojas EIRL',
                'direccion' => 'Jr. Amazonas 456, Trujillo',
                'correo' => 'ventas@rojasind.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ruc' => '20567891234',
                'razon_social' => 'Comercial Andina SAC',
                'direccion' => 'Calle Los Cedros 789, Arequipa',
                'correo' => 'info@andinasac.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ruc' => '20678912345',
                'razon_social' => 'Tecnología Verde SAC',
                'direccion' => 'Av. Javier Prado Este 1122, Lima',
                'correo' => 'contacto@tecnologiaverde.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ruc' => '20789123456',
                'razon_social' => 'Soluciones Integrales del Sur SRL',
                'direccion' => 'Av. Grau 321, Cusco',
                'correo' => 'soporte@solsur.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
