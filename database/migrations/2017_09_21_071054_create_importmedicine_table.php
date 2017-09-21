<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportmedicineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('importmedicine', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('medicine_id');
            $table->integer('amount');
            $table->float('importedprice');
            $table->string('importeddatetime');
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
        Schema::drop('importmedicine');
    }
}
