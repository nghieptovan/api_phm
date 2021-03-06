<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresriptionDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptiondetail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prescription_id');
            $table->integer('medicine_id');
            $table->string('daydrink');
            $table->integer('timesperday');
            $table->integer('daycount');
            $table->integer('number');            
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
        Schema::drop('prescriptiondetail');
    }
}
