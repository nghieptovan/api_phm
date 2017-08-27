<?php

use Illuminate\Database\Seeder;

class PrescriptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('prescription')->insert([
            'name' => 'Toa thuốc mẫu 1',
            'code' => 'toamau1',
        ]);
        DB::table('prescription')->insert([
            'name' => 'Toa thuốc mẫu 2',
            'code' => 'toamau2',
        ]);
        DB::table('prescription')->insert([
            'name' => 'Toa thuốc mẫu 2',
            'code' => 'toamau2',
        ]);
    }
}
