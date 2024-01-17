<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatalogosDetallesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('catalogos_detalles')->insert(['id'=>1001, 'catalogo_id'=>1, 'opcion' => 'Borrador', 'valor'=>1, 'css' => '', 'orden' => '1', 'activo' => 1]);
        \DB::table('catalogos_detalles')->insert(['id'=>1002, 'catalogo_id'=>1, 'opcion' => 'Disponible', 'valor'=>2, 'css' => '', 'orden' => '2', 'activo' => 1]);
        \DB::table('catalogos_detalles')->insert(['id'=>1003, 'catalogo_id'=>1, 'opcion' => 'Edición', 'valor'=>3, 'css' => '', 'orden' => '3', 'activo' => 1]);
        \DB::table('catalogos_detalles')->insert(['id'=>1004, 'catalogo_id'=>1, 'opcion' => 'Inactivo', 'valor'=>4, 'css' => '', 'orden' => '4', 'activo' => 1]);

        \DB::table('catalogos_detalles')->insert(['id'=>9001, 'catalogo_id'=>9, 'opcion' => 'Activo', 'valor'=>1, 'css' => '', 'orden' => '1', 'activo' => 1]);
        \DB::table('catalogos_detalles')->insert(['id'=>9002, 'catalogo_id'=>9, 'opcion' => 'Inactivo', 'valor'=>2, 'css' => '', 'orden' => '2', 'activo' => 1]);
    }
}
