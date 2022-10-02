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
        Schema::create('student_accounts', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('type');
            $table->bigInteger('fee_invoice_id')->nullable()->unsigned();
            $table->bigInteger('receipt_id')->nullable()->unsigned();
            $table->bigInteger('student_id')->unsigned();
            $table->bigInteger('processing_id')->nullable()->unsigned();
            $table->bigInteger('payment_id')->nullable()->unsigned();
            $table->decimal('Debit', 8, 2)->nullable();
            $table->decimal('credit', 8, 2)->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('student_accounts');
    }
};
