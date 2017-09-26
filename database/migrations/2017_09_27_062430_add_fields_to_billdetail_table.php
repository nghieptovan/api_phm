<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToBilldetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('billdetail', function (Blueprint $table) {
            //
            $table->dropColumn('number');
            $table->dropColumn('daycount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('billdetail', function (Blueprint $table) {
            //
            $table->float('number');
            $table->float('daycount');
        });
    }
}
