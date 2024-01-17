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
        Schema::create('list', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->string('color');
            $table->string('lote');
            $table->string('paquete');
            $table->string('kilos')->nullable();
            $table->string('costo')->nullable();
            $table->string('presio')->nullable();
            $table->string('numero')->nullable();
            $table->string('repetido')->nullable();
            $table->integer('space')->unsigned();
            $table->integer('status')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('space')->references('id')->on('space');
            $table->foreign('status')->references('id')->on('catalogos_detalles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('list', function (Blueprint $table) {
            //
        });
    }
};
