<?php

namespace Database\Seeders\Fragments;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BdgtRqstSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('g59_budget_requests')->insert([
            'budget_code' => "BC" . uniqid(),
            'budget_type' => 'T1',
            'budget_period' => 'Q1',
            'budget_date' => '2023-10-03',
            'budget_department' => 1004,
            'budget_amount' => '10000',
            'budget_name' => 'Marketing Conference',
            'budget_justification' => 'Attend marketing conference in San Francisco',
            'budget_optional' => 'N',
            'budget_category' => 'C7',
            'budget_approvedAmount' => '9500',
            'budget_notes' => '',
            'budget_status' => 'S1',
            'budget_approvedBy' => 'johnrey.miranda',
            'budget_approvedDate' => '2023-10-03',
            'created_at' => now(),
            'updated_at' => now(),

            'budget_createdBy' => 'jasonryan.odvina'

        ]);

        DB::table('g59_budget_requests')->insert([
            'budget_code' => "BC" . uniqid(),
            'budget_type' => 'T1',
            'budget_period' => 'A1',
            'budget_date' => '2023-10-07',
            'budget_department' => 1002,
            'budget_amount' => '5000',
            'budget_name' => 'New Sales Software',
            'budget_justification' => 'Purchase new sales software for the sales team',
            'budget_optional' => 'N',
            'budget_category' => 'C4',
            'budget_approvedAmount' => '5200',
            'budget_notes' => 'Additional costs for training and implementation',
            'budget_status' => 'S1',
            'budget_approvedBy' => 'jasonryan.odvina',
            'budget_approvedDate' => '2023-10-09',
            'created_at' => now(),
            'updated_at' => now(),

            'budget_createdBy' => 'ivan.laguda'

        ]);

        DB::table('g59_budget_requests')->insert([
            'budget_code' => "BC" . uniqid(),
            'budget_type' => 'T1',
            'budget_period' => 'SA2',
            'budget_date' => '2023-10-23',
            'budget_department' => 1003,
            'budget_amount' => '2000',
            'budget_name' => 'New Servers',
            'budget_justification' => 'Purchase new servers to support the growing company',
            'budget_optional' => 'N',
            'budget_category' => 'C3',
            'budget_approvedAmount' => '2500',
            'budget_notes' => 'Unexpected increase in server costs',
            'budget_status' => 'S1',
            'budget_approvedBy' => 'johnrey.miranda',
            'budget_approvedDate' => '2023-10-16',
            'created_at' => now(),
            'updated_at' => now(),

            'budget_createdBy' => 'jonas.pelicia'

        ]);

        DB::table('g59_budget_requests')->insert([
            'budget_code' => "BC" . uniqid(),
            'budget_type' => 'T1',
            'budget_period' => 'Q4',
            'budget_date' => '2023-11-05',
            'budget_department' => 1004,
            'budget_amount' => '1500',
            'budget_name' => 'Employee Training',
            'budget_justification' => 'Provide employee training on new company policies and procedures',
            'budget_optional' => 'N',
            'budget_category' => 'C1',
            'budget_approvedAmount' => '1200',
            'budget_notes' => 'Fewer employees attended training than expected',
            'budget_status' => 'S1',
            'budget_approvedBy' => 'jasonryan.odvina',
            'budget_approvedDate' => '2023-10-23',
            'created_at' => now(),
            'updated_at' => now(),

            'budget_createdBy' => 'jayson.azucena'

        ]);

        DB::table('g59_budget_requests')->insert([
            'budget_code' => "BC" . uniqid(),
            'budget_type' => 'T1',
            'budget_period' => 'Q2',
            'budget_date' => '2023-12-03',
            'budget_department' => 1002,
            'budget_amount' => '1000',
            'budget_name' => 'Office Supplies',
            'budget_justification' => 'Purchase office supplies for the company',
            'budget_optional' => 'N',
            'budget_category' => 'C8',
            'budget_approvedAmount' => '900',
            'budget_notes' => 'Lower-than-expected office supply usage',
            'budget_status' => 'S1',
            'budget_approvedBy' => 'johnrey.miranda',
            'budget_approvedDate' => '2023-10-30',
            'created_at' => now(),
            'updated_at' => now(),

            'budget_createdBy' => 'johnrey.miranda'

        ]);


    }
}
