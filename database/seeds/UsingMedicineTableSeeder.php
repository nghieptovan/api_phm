<?php

use Illuminate\Database\Seeder;

class UsingMedicineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('usingmedicine')->insert([
            'cachsudung' => 'viên',
        ]);
        DB::table('usingmedicine')->insert([
            'cachsudung' => 'bột',
        ]);
        DB::table('usingmedicine')->insert([
            'cachsudung' => 'nước',
        ]);
    }
}
