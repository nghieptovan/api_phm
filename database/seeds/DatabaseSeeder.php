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

        DB::table('medicines')->insert([
            'mathuoc' => 'Med10294',
            'tenthuoc' => 'Panadol',
            'tenthuoc_toa' => 'panadol 500mg',
            'typemedicine_id' => '1',
            'usingmedicine_id' => '1',
            'soluong' => '50',
            'soluongxuat' => '40',
            'dongia' => '5000',
            'nhandang' => 'uống sau ăn',
        ]);

        $this->call(EmployeeTableSeeder::class);
        $this->call(PatientTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(StatusTableSeeder::class);
        $this->call(TypeMedicineTableSeeder::class);
        $this->call(UsingMedicineTableSeeder::class);

    }
}
