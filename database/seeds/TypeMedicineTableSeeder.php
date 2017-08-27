<?php

use Illuminate\Database\Seeder;

class TypeMedicineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('typemedicine')->insert([
            'name' => 'kháng sinh',
            'code' => 'ks',
        ]);
        DB::table('typemedicine')->insert([
            'name' => 'giảm đau',
            'code' => 'gd',
        ]);
    }
}
