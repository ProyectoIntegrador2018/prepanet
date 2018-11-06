<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->increments('id');

            $table->string('first_name');
            $table->string('last_name');
            $table->char('gender', 1);
            $table->dateTime('birth_date');
            $table->string('work_email');
            $table->string('email');
            $table->string('phone');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('tutor_type');
            $table->string('carreer');

            $table->string('business')->nullable();

            $table->integer('gerente_id')->unsigned();
            $table->foreign('gerente_id')
                ->references('id')
                ->on('gerentes');

            $table->integer('tetra_id')->unsigned();
            $table->foreign('tetra_id')
                ->references('id')
                ->on('tetras');

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
        Schema::dropIfExists('alumnos');
    }
}
