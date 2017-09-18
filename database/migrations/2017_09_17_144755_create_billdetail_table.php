<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBilldetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billdetail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bill_id');
            $table->integer('medicine_id');
            $table->float('price');
            $table->integer('timesperday');
            $table->string('daydrink');
            $table->integer('number');
            $table->integer('daycount');
            $table->string('description');
            $table->integer('isDelete')->default('0');
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
        Schema::drop('billdetail');
    }
}
