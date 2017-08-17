<?php

use Illuminate\Database\Seeder;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('employees')->insert([
            'username' => 'admin',
            'password' => str_random(10),
            'position' => 'admin',
            'role_id' => 1,
        ]);
        DB::table('employees')->insert([
            'username' => 'nhanvien',
            'password' => '123456',
            'role_id' => 1,
        ]);
    }
}
