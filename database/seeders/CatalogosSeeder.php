<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatalogosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('catalogos')->insert(['id'=>1, 'nombre'=>'Estatus de la registro' ,'css' => '', 'orden' => '1', 'activo' => 1]);
        \DB::table('catalogos')->insert(['id'=>9, 'nombre'=>'Status Menu' ,'css' => '', 'orden' => '9', 'activo' => 1]);
    }
}
