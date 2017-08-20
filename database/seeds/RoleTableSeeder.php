<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('role')->insert([
            'id' => '1',
            'name' => 'admin',
            'code' => 'adm',
        ]);
        DB::table('role')->insert([
            'id' => '2',
            'name' => 'Tiếp tân',
            'code' => 'tt',
        ]);
        DB::table('role')->insert([
            'id' => '3',
            'name' => 'Bác sỹ',
            'code' => 'bs',
        ]);
        DB::table('role')->insert([
           'id' => '4',
            'name' => 'Phát thuốc',
            'code' => 'pt',
        ]);
    }
}
