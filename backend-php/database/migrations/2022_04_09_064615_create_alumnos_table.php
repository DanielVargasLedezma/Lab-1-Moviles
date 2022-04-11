<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->string('cedula_alumno')->primary();
            $table->string('nombre');
            $table->bigInteger('telefono');
            $table->string('correoE')->unique();
            $table->date('fecha_nacimiento');
            $table->string('codigo_carrera');
            $table->string('clave');

            $table->foreign('codigo_carrera')
                ->references('codigo_carrera')
                ->on('carreras')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumnos');
    }
};
