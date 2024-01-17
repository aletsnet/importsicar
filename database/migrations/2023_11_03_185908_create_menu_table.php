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
        Schema::create('menu', function (Blueprint $table) {
            //create
            $table->increments('id');
            $table->string('menu');
            $table->string('ruta')->nullable();
            $table->string('url')->nullable();
            $table->string('icon')->nullable();
            $table->integer('padre')->nullable()->unsigned();
            $table->integer('status')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('status')->references('id')->on('catalogos_detalles');
            $table->foreign('padre')->references('id')->on('menu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
