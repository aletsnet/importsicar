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
        Schema::create('roles', function (Blueprint $table) {
            //create
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
            
            //index
            $table->index('nombre');
        });

        
        //alter table
        Schema::table('users', function (Blueprint $table) {
            $table->integer('rol_id')->unsigned();
            $table->softDeletes();
            
            $table->foreign('rol_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
