<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAplicacionAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aplicacion_alumnos', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('submitted_on');

            $table->integer('alumno_id')->unsigned();
            $table->foreign('alumno_id')
                ->references('id')
                ->on('alumnos');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aplicacion_alumnos');
    }
}
