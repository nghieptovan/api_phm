<?php

use Illuminate\Database\Seeder;

class PrescriptionDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('prescriptiondetail')->insert([
            'prescription_id' => '1',
            'medicine_id' => '1',
        ]);
        DB::table('prescriptiondetail')->insert([
            'prescription_id' => '1',
            'medicine_id' => '2',
        ]);
        DB::table('prescriptiondetail')->insert([
            'prescription_id' => '2',
            'medicine_id' => '1',
        ]);
        DB::table('prescriptiondetail')->insert([
            'prescription_id' => '2',
            'medicine_id' => '2',
        ]);
        DB::table('prescriptiondetail')->insert([
            'prescription_id' => '3',
            'medicine_id' => '1',
        ]);
    }
}
