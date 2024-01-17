<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menu_permisos', function (Blueprint $table) {
            //create
            $table->increments('id');
            $table->integer('roles')->unsigned();
            $table->integer('menu')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('roles')->references('id')->on('roles');
            $table->foreign('menu')->references('id')->on('menu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_permisos');
    }
};
