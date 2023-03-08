<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateclassroomsTable extends Migration
{
    public function up()
    {
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('Name_class');
            $table->bigInteger('grade_id')->unsigned();
            $table->engine = 'InnoDB';
        });
    }

    public function down()
    {
        Schema::drop('classrooms');
    }
}
