<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFieldsPrescriptiondetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE prescriptiondetail MODIFY timesperday DOUBLE;');
        DB::statement('ALTER TABLE prescriptiondetail MODIFY daycount DOUBLE;');
        DB::statement('ALTER TABLE prescriptiondetail MODIFY number DOUBLE;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE prescriptiondetail MODIFY timesperday INT;');
        DB::statement('ALTER TABLE prescriptiondetail MODIFY daycount INT;');
        DB::statement('ALTER TABLE prescriptiondetail MODIFY number INT;');
    }
}
