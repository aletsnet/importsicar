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
        Schema::create('catalogos_detalles', function (Blueprint $table) {
            //crear
            $table->increments('id');
            $table->integer('catalogo_id')->unsigned();
            $table->string('opcion');
            $table->string('valor');
            $table->string('icon')->nullable();
            $table->string('css')->nullable();
            $table->string('style')->nullable();
            $table->string('picture')->nullable();
            $table->boolean('activo')->default(true);
            $table->integer('orden');
            $table->timestamps();
            $table->softDeletes();
            
            //index
            $table->index('opcion');
            $table->index('valor');

            //llave foranea
            $table->foreign('catalogo_id')->references('id')->on('catalogos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogos_detalles');
    }
};
