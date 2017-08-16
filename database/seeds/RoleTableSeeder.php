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
            'role_id' => '1',
            'role_name' => 'admin',
        ]);
        DB::table('role')->insert([
            'role_id' => '2',
            'role_name' => 'tieptan',
        ]);
        DB::table('role')->insert([
            'role_id' => '3',
            'role_name' => 'bacsi',
        ]);
        DB::table('role')->insert([
            'role_id' => '4',
            'role_name' => 'phatthuoc',
        ]);
    }
}
