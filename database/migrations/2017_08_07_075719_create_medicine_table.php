<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mathuoc')->unique();
            $table->string('tenthuoc');
            $table->string('tenthuoc_toa');
            $table->integer('usingmedicine_id');
            $table->integer('typemedicine_id');
            $table->integer('soluong');
            $table->integer('soluongxuat');
            $table->integer('dongia');
            $table->string('nhandang');
            $table->timestamp('ngaynhap');
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
        Schema::drop('medicines');
    }
}
