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

        // crear un encabexado para las actividades y relacionar las asistencias a este encabezado

        Schema::create('weps_actividad', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_actividad', 100);
            $table->date('fecha_actividad');
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });

        Schema::create('weps_asistencia', function (Blueprint $table) {
            $table->id('id_asistencia');
            $table->unsignedBigInteger('id_actividad_fk');
            $table->integer('id_persona_fk');
            $table->text('observacion')->nullable();
            $table->timestamp('ingreso')->nullable();
            $table->timestamp('salida')->nullable();
            $table->date('fecha_asistencia');
            $table->timestamps();
            $table->string('estado_asistencia', 15)->default('REGISTRADO');
            $table->integer('permiso')->default(0);
            $table->index('id_actividad_fk', 'fk_weps_asistencia_weps_actividad1_idx');
            $table->foreign('id_actividad_fk', 'weps_asistencia_ibfk_2')->references('id')->on('weps_actividad');
            $table->foreign('id_persona_fk', 'weps_asistencia_ibfk_1')->references('id_persona')->on('weps_persona');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('weps_asistencia');
        Schema::dropIfExists('weps_actividad');
    }
};
