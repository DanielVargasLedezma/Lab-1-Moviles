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
        Schema::create('grupos', function (Blueprint $table) {
            $table->string('numero_grupo')->primary();
            $table->string('codigo_curso');
            $table->string('cedula_profesor');
            $table->bigInteger('id_ciclo')->unsigned();
            $table->string('horario');
            $table->string('dia_uno');
            $table->string('dia_dos')->nullable();

            $table->foreign('codigo_curso')
                ->references('codigo_curso')
                ->on('cursos')
                ->onDelete('cascade');

            $table->foreign('id_ciclo')
                ->references('id_ciclo')
                ->on('ciclos')
                ->onDelete('cascade');

            $table->foreign('cedula_profesor')
                ->references('cedula_profesor')
                ->on('profesores')
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
        Schema::dropIfExists('grupos');
    }
};
