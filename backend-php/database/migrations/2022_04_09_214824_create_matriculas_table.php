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
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id('numero_matricula');
            $table->string('cedula_alumno');
            $table->string('numero_grupo');
            $table->smallInteger('nota');

            $table->foreign('cedula_alumno')
                ->references('cedula_alumno')
                ->on('alumnos')
                ->onDelete('cascade');

            $table->foreign('numero_grupo')
                ->references('numero_grupo')
                ->on('grupos')
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
        Schema::dropIfExists('matriculas');
    }
};
