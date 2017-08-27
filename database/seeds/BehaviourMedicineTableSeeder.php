<?php

use Illuminate\Database\Seeder;

class BehaviourMedicineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('behaviourmedicine')->insert([
            'name' => 'viên',
            'code' => 'v',
        ]);
        DB::table('behaviourmedicine')->insert([
            'name' => 'bột',
            'code' => 'b',
        ]);
        DB::table('behaviourmedicine')->insert([
            'name' => 'nước',
            'code' => 'n',
        ]);
    }
}


