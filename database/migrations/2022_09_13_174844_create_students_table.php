<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->bigInteger('gender_id')->unsigned();
            $table->bigInteger('nationalitie_id')->unsigned();
            $table->bigInteger('blood_id')->unsigned();
            $table->date('Date_Birth');
            $table->bigInteger('grade_id')->unsigned();
            $table->bigInteger('classroom_id')->unsigned();
            $table->bigInteger('section_id')->unsigned();
            $table->bigInteger('parent_id')->unsigned();
            $table->string('academic_year');
            $table->softDeletes();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
