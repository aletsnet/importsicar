<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuPermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \DB::table('menu_permisos')->insert(['roles'=>1, 'menu'=>1000]);
        \DB::table('menu_permisos')->insert(['roles'=>1, 'menu'=>2000]);
        \DB::table('menu_permisos')->insert(['roles'=>1, 'menu'=>9000]);
        \DB::table('menu_permisos')->insert(['roles'=>1, 'menu'=>1001]);
        \DB::table('menu_permisos')->insert(['roles'=>1, 'menu'=>2001]);
        \DB::table('menu_permisos')->insert(['roles'=>1, 'menu'=>9001]);
        \DB::table('menu_permisos')->insert(['roles'=>1, 'menu'=>9002]);
        \DB::table('menu_permisos')->insert(['roles'=>1, 'menu'=>9003]);
    }
}
