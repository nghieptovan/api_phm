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
            'daydrink' => 'nua vien',
            'timesperday' => '2',
            'daycount' => '5',
            'number' => '5', 
        ]);
        DB::table('prescriptiondetail')->insert([
            'prescription_id' => '1',
            'medicine_id' => '2',
            'daydrink' => '1 vien',
            'timesperday' => '3',
            'daycount' => '5',
            'number' => '15', 
        ]);
        DB::table('prescriptiondetail')->insert([
            'prescription_id' => '2',
            'medicine_id' => '1',
            'daydrink' => '1 vien',
            'timesperday' => '3',
            'daycount' => '5',
            'number' => '15', 
        ]);
        DB::table('prescriptiondetail')->insert([
            'prescription_id' => '2',
            'medicine_id' => '2',
            'daydrink' => '1 vien',
            'timesperday' => '3',
            'daycount' => '5',
            'number' => '15', 
        ]);
        DB::table('prescriptiondetail')->insert([
            'prescription_id' => '3',
            'medicine_id' => '1',
            'daydrink' => '1 vien',
            'timesperday' => '3',
            'daycount' => '5',
            'number' => '15', 
        ]);
    }
}
