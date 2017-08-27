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

        $this->call(EmployeeTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(DiagnosisTableSeeder::class);
        $this->call(BehaviourMedicineTableSeeder::class);
        $this->call(TypeMedicineTableSeeder::class);
        $this->call(PrescriptionTableSeeder::class);
        $this->call(PrescriptionDetailTableSeeder::class);
        $this->call(MedicinesTableSeeder::class);
        // $this->call(PatientTableSeeder::class);
        
        // $this->call(StatusTableSeeder::class);
        // 

    }
}
