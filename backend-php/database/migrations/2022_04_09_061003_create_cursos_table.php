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
        Schema::create('cursos', function (Blueprint $table) {
            $table->string('codigo_curso')->primary();
            $table->string('codigo_carrera')->nullable();
            $table->string('nombre');
            $table->smallInteger('creditos');
            $table->smallInteger('horas_semanales');
            $table->smallInteger('num_semestre_a_llevar');
            $table->string('anyo_a_llevar');

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
        Schema::dropIfExists('cursos');
    }
};
