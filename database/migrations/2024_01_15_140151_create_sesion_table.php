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
        Schema::create('space', function (Blueprint $table) {
            //create
            $table->increments('id');
            $table->string('proceso');
            $table->integer('status')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('status')->references('id')->on('catalogos_detalles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('space');
    }
};
