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
        Schema::create('weps_pagina', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 200);
            $table->text('enlace')->nullable();
            $table->integer('compartidas')->unsigned();
            $table->integer('me_gusta')->unsigned();
            $table->integer('id_bloque');
            $table->integer('id_persona');
            $table->string('tipo', 50);
            $table->foreign('id_bloque')->references('id_grupo_entrenamiento')->on('weps_grupo_entrenamiento')->onDelete('restrict');
            $table->foreign('id_persona')->references('id_persona')->on('weps_persona')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weps_pagina');
    }
};
