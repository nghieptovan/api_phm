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
            'username' => 'admin',
            'password' => str_random(10),
            'position' => 'admin',
            'role_id' => 1,
        ]);
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
        DB::table('patient')->insert([
            'mabenhnhan' => 'BN20170816103422',
            'hoten' => 'Lê Văn B',
            'gioitinh' => '1',
            'cannang' => '65',
            'ngaysinh' => '1998-08-16 10:16:01',
            'diachi' => '1 CMT8',
            'sodienthoai' => '0909xxxxx',
            'tiencan' => 'Không có tiền căn',
            'employee_id' => '1',
        ]);

    }
}
