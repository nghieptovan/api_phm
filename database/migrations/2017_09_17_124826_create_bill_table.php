<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');
            $table->string('billdate');
            $table->string('symptom');
            $table->integer('diagnosis_id');
            $table->string('subdiagnosis');
            $table->string('introduction');
            $table->string('nextdate');
            $table->integer('index');
            $table->integer('doctor_id');
            $table->integer('dispenser_id');
            $table->string('dispensedatetime');
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
        Schema::drop('bill');
    }
}
