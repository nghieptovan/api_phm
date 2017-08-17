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
            'tenloai' => 'kháng sinh',
        ]);
        DB::table('typemedicine')->insert([
            'tenloai' => 'giảm đau',
        ]);
    }
}
