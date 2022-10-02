<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration
{
    public function up()
    {
        Schema::table('classrooms', function (Blueprint $table) {
            $table->foreign('Grade_id')->references('id')->on('grades')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('sections', function (Blueprint $table) {
            $table->foreign('Grade_id')->references('id')->on('grades')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('sections', function (Blueprint $table) {
            $table->foreign('Class_id')->references('id')->on('classrooms')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('my__parents', function (Blueprint $table) {
            $table->foreign('Nationality_Father_id')->references('id')->on('nationalities');
            $table->foreign('Blood_Type_Father_id')->references('id')->on('type__bloods');
            $table->foreign('Religion_Father_id')->references('id')->on('religions');
            $table->foreign('Nationality_Mother_id')->references('id')->on('nationalities');
            $table->foreign('Blood_Type_Mother_id')->references('id')->on('type__bloods');
            $table->foreign('Religion_Mother_id')->references('id')->on('religions');
        });

        Schema::table('parent_attachments', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('my__parents')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('teachers', function (Blueprint $table) {
            $table->foreign('Specialization_id')->references('id')->on('specializations')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('teachers', function (Blueprint $table) {
            $table->foreign('Gender_id')->references('id')->on('genders')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('teacher_section', function (Blueprint $table) {
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->foreign('gender_id')->references('id')->on('genders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('nationalitie_id')->references('id')->on('nationalities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('blood_id')->references('id')->on('type__bloods')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('Grade_id')->references('id')->on('Grades')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('Classroom_id')->references('id')->on('Classrooms')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('parent_id')->references('id')->on('my__parents')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('promotions', function (Blueprint $table) {
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('from_grade')->references('id')->on('Grades')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('from_Classroom')->references('id')->on('Classrooms')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('from_section')->references('id')->on('sections')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('to_grade')->references('id')->on('Grades')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('to_Classroom')->references('id')->on('Classrooms')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('to_section')->references('id')->on('sections')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('fees', function (Blueprint $table) {
            $table->foreign('Grade_id')->references('id')->on('Grades')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('Classroom_id')->references('id')->on('Classrooms')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('fee_invoices', function (Blueprint $table) {
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('Grade_id')->references('id')->on('Grades')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('Classroom_id')->references('id')->on('Classrooms')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('fee_id')->references('id')->on('fees')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('student_accounts', function (Blueprint $table) {
            $table->foreign('fee_invoice_id')->references('id')->on('fee_invoices')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('receipt_id')->references('id')->on('receipt_students')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('processing_id')->references('id')->on('processing_fees')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('payment_id')->references('id')->on('payment_students')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('receipt_students', function (Blueprint $table) {
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('fund_accounts', function (Blueprint $table) {
            $table->foreign('receipt_id')->references('id')->on('receipt_students')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('payment_id')->references('id')->on('receipt_students')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('processing_fees', function (Blueprint $table) {
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('payment_students', function (Blueprint $table) {
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('attendances', function (Blueprint $table) {
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('grade_id')->references('id')->on('Grades')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('classroom_id')->references('id')->on('Classrooms')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('subjects', function (Blueprint $table) {
            $table->foreign('grade_id')->references('id')->on('Grades')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('classroom_id')->references('id')->on('Classrooms')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('quizzes', function (Blueprint $table) {
            $table->foreign('grade_id')->references('id')->on('Grades')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('classroom_id')->references('id')->on('Classrooms')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('questions', function (Blueprint $table) {
            $table->foreign('quizze_id')->references('id')->on('quizzes')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('online_classes', function (Blueprint $table) {
            $table->foreign('Grade_id')->references('id')->on('Grades')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('Classroom_id')->references('id')->on('Classrooms')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('library', function (Blueprint $table) {
            $table->foreign('Grade_id')->references('id')->on('Grades')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('Classroom_id')->references('id')->on('Classrooms')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('degrees', function (Blueprint $table) {
            $table->foreign('quizze_id')->references('id')->on('quizzes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::table('classrooms', function (Blueprint $table) {
            $table->dropForeign('classrooms_Grade_id_foreign');
        });
        Schema::table('sections', function (Blueprint $table) {
            $table->dropForeign('sections_Grade_id_foreign');
        });
        Schema::table('sections', function (Blueprint $table) {
            $table->dropForeign('sections_Class_id_foreign');
        });
    }
}
