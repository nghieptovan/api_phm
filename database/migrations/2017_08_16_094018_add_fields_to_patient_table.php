<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToPatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient', function (Blueprint $table) {
            //
            $table->string('mabenhnhan');
            $table->string('hoten');
            $table->boolean('gioitinh');
            $table->string('cannang');
            $table->timestamp('ngaysinh');
            $table->string('diachi');
            $table->string('sodienthoai');
            $table->string('tiencan');
            $table->string('employee_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patient', function (Blueprint $table) {
            //
        });
    }
}
