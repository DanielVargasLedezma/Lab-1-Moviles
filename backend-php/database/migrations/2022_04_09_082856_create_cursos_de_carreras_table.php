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
        Schema::create('cursos_de_carreras', function (Blueprint $table) {
            $table->string('codigo_carrera');
            $table->string('codigo_curso');
            $table->bigInteger('id_ciclo')->unsigned();

            $table->smallInteger('year');

            $table->foreign('codigo_carrera')
                ->references('codigo_carrera')
                ->on('carreras')
                ->onDelete('cascade');

            $table->foreign('codigo_curso')
                ->references('codigo_curso')
                ->on('cursos')
                ->onDelete('cascade');

            $table->foreign('id_ciclo')
                ->references('id_ciclo')
                ->on('ciclos')
                ->onDelete('cascade');

            $table->primary(['codigo_carrera', 'codigo_curso', 'id_ciclo']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cursos_de_carreras');
    }
};
