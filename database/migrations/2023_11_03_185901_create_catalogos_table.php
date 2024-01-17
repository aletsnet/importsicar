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
        Schema::create('catalogos', function (Blueprint $table) {
            //crear
            $table->increments('id');
            $table->string('nombre');
            $table->string('icon')->nullable();
            $table->string('css')->nullable();
            $table->string('style')->nullable();
            $table->string('picture')->nullable();
            $table->boolean('activo')->default(true);
            $table->integer('orden');
            $table->timestamps();
            $table->softDeletes();

            $table->index('nombre');

            //llaves foraneas
            //$table->foreign('catalogo_id')->references('id')->on('catalogos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogos');
    }
};
