<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //roles
        \DB::table('roles')->insert(['id'=>1, 'nombre'=>'Administrador' ,'css' => '', 'orden' => '1', 'activo' => 1]);
        \DB::table('roles')->insert(['id'=>2, 'nombre'=>'Gerente' ,'css' => '', 'orden' => '2', 'activo' => 1]);
    }
}
