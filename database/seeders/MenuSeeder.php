<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \DB::table('menu')->insert(['id'=>1000, 'menu'=>'Sesiones', 'status' => 9002]);
        \DB::table('menu')->insert(['id'=>2000, 'menu'=>'Lista', 'status' => 9001]);
        \DB::table('menu')->insert(['id'=>9000, 'menu'=>'Sistemas', 'status' => 9001]);
        \DB::table('menu')->insert(['id'=>1001, 'padre'=>1000, 'menu'=>'Buscar', 'ruta'=>'sesiones.index', 'status' => 9002]);
        \DB::table('menu')->insert(['id'=>2001, 'padre'=>2000, 'menu'=>'Listas', 'ruta'=>'lista.page', 'status' => 9001]);
        \DB::table('menu')->insert(['id'=>9001, 'padre'=>9000, 'menu'=>'Usuarios', 'ruta'=>'user.index', 'status' => 9001]);
        \DB::table('menu')->insert(['id'=>9002, 'padre'=>9000, 'menu'=>'Perfil', 'ruta'=>'user.perfil', 'status' => 9001]);
        \DB::table('menu')->insert(['id'=>9003, 'padre'=>9000, 'menu'=>'Configuracion', 'ruta'=>'user.conf', 'status' => 9002]);
        //system_menu_permisos
    }
}
