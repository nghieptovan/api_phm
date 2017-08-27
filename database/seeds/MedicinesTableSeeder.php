<?php

use Illuminate\Database\Seeder;

class MedicinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('medicines')->insert([
            'code' => 'Med10294',
            'name' => 'Panadol',
            'display_name' => 'panadol 500mg',
            'description' => 'chống chỉ định cho trẻ em',
            'amount' => '50',
            'typemedicine_id' => '1',
            'behaviourmedicine_id' => '1',
            'sellprice' => '2500',
            'importedprice' => '2000',
        ]);
        DB::table('medicines')->insert([
            'code' => 'Pal10490',
            'name' => 'Paracetamol',
            'display_name' => 'Paracetamol 500mg',
            'description' => 'uống sau ăn',
            'amount' => '20',
            'typemedicine_id' => '2',
            'behaviourmedicine_id' => '2',
            'sellprice' => '5500',
            'importedprice' => '3000',
        ]);
    }

}
