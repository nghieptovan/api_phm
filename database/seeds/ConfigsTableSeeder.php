<?php

use Illuminate\Database\Seeder;

class ConfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('configs')->insert([
            'key' => 'tiemkham',
            'value' => '100000',
        ]);
        DB::table('configs')->insert([
            'key' => 'abc',
            'value' => '1000',
        ]);
    }
}
