<?php

namespace Database\Seeders\Fragments;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('g59_departments')->insert([
            'department_code' => '1001',
            'department_name' => 'Admin',
        ]);

        DB::table('g59_departments')->insert([
            'department_code' => '1002',
            'department_name' => 'Human Resource ',
        ]);

        DB::table('g59_departments')->insert([
            'department_code' => '1003',
            'department_name' => 'Logistics',
        ]);

        DB::table('g59_departments')->insert([
            'department_code' => '1004',
            'department_name' => 'Finance',
        ]);

        DB::table('g59_departments')->insert([
            'department_code' => '1005',
            'department_name' => 'LGU',
        ]);

        DB::table('g59_departments')->insert([
            'department_code' => '1006',
            'department_name' => 'Hotel & Restaurant',
        ]);

    }
}
