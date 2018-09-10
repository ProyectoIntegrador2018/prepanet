<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('work_phone');
            $table->char('gender', 1);
            $table->date('birth_date');
            $table->string('street');
            $table->string('street_number');
            $table->string('neighborhood');
            $table->string('community')->nullable();
            $table->string('city');
            $table->string('zipcode');
            $table->string('state');
            $table->string('country');

            $table->string('user_name');
            $table->string('user_password');

            $table->integer('campus_id')->unsigned();
            $table->foreign('campus_id')
                ->references('id')
                ->on('campuses');

            $table->integer('gerente_id')->unsigned();
            $table->foreign('gerente_id')
                ->references('id')
                ->on('gerentes');

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
        Schema::dropIfExists('tutors');
    }
}
