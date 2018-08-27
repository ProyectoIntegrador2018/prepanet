<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAplicacionTutorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aplicacion_tutors', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('submitted_on');

            $table->integer('tutor_id')->unsigned();
            $table->foreign('tutor_id')
                ->references('id')
                ->on('tutors');

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
        Schema::dropIfExists('aplicacion_tutors');
    }
}
