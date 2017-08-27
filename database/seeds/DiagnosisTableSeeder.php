<?php

use Illuminate\Database\Seeder;

class DiagnosisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('diagnosis')->insert([
            'name' => 'Viêm họng',
            'code' => 'viemhong',
            'short_name' => 'VH',
        ]);
        DB::table('diagnosis')->insert([
            'name' => 'Viêm mũi',
            'code' => 'viemmui',
            'short_name' => 'VM',
        ]);
        DB::table('diagnosis')->insert([
            'name' => 'Viêm phổi',
            'code' => 'viemphoi',
            'short_name' => 'VP',
        ]);
    }
}
