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
        Schema::table('weps_persona', function (Blueprint $table) {
            $table->integer('id_grupo_entrenamiento')->nullable();
            $table->foreign('id_grupo_entrenamiento')->references('id_grupo_entrenamiento')->on('weps_grupo_entrenamiento')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('weps_persona', function (Blueprint $table) {
            $table->dropForeign(['id_grupo_entrenamiento']);
            $table->dropColumn('id_grupo_entrenamiento');
        });
    }
};
