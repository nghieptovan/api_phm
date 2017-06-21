<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('employees')->insert([
            'username' => str_random(10),
            'password' => str_random(10),
            'position' => 'employee',
        ]);
    }
}
