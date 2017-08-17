<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('status')->insert([
            'status_name' => 'moidangki',
        ]);
        DB::table('status')->insert([
            'status_name' => 'chotaikham',
        ]);
        DB::table('status')->insert([
            'status_name' => 'dakham',
        ]);
    }
}
