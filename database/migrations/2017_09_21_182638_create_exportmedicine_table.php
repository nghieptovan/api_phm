<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExportmedicineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exportmedicine', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('medicine_id');
            $table->integer('amount');
            $table->float('exportedprice');
            $table->string('exporteddatetime');
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
        Schema::drop('exportmedicine');
    }
}
