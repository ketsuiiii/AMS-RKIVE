<?php

namespace Database\Seeders\Fragments;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddBdgtRqstSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('g59_addbudget_requests')->insert([
            'request_code' => "RC". uniqid(),
            'request_name' => 'Conference',
            'request_amount' => '20000',
            'request_category' => 'C7',
            'request_type' => 'T2',
            'request_department' => 1004,
            'request_actualSpending' => '30000',
            'request_justification' => 'Attend marketing conference in San Angelo',
            'request_optional' => 'N',
            'request_period' => 'SA2',
            'request_date' => '2023-10-03',
            'request_projectDetails' => 1,
            // 'request_historicalData',
            // 'request_riskFactorsAndContingencies',
            // 'request_impactOnOperations',
            // 'request_alignmentWithObjectives',
            // 'request_alternativesConsidered',
            // 'request_supportingDocumentation',
            // 'request_assumptionsAndMethodology',
            'request_status' => 'S1',
            'request_approvedBy' => 'johnrey.miranda',
            'request_approvedDate' => '2023-10-03',
            'request_approvedAmount' => '20000',
            'created_at' => now(),
            'updated_at' => now(),

            'request_createdBy' => 'jonas.pelicia',

        ]);

        DB::table('g59_addbudget_requests')->insert([
            'request_code' => "RC". uniqid(),
            'request_name' => 'Old Sales Software',
            'request_amount' => '1000',
            'request_category' => 'C4',
            'request_type' => 'T2',
            'request_department' => 1002,
            'request_optional' => 'N',
            'request_period' => 'A1',
            'request_date' => '2023-11-13',
            'request_projectDetails' => 2,
            // 'request_historicalData',
            // 'request_riskFactorsAndContingencies',
            // 'request_impactOnOperations',
            // 'request_alignmentWithObjectives',
            // 'request_alternativesConsidered',
            // 'request_supportingDocumentation',
            // 'request_assumptionsAndMethodology',
            'request_actualSpending' => '6000',
            'request_justification' => 'Additional costs for training and implementation',
            'request_status' => 'S1',
            'request_approvedBy' => 'jasonryan.odvina',
            'request_approvedDate' => '2023-10-03',
            'request_approvedAmount' => '1000',
            'created_at' => now(),
            'updated_at' => now(),

            'request_createdBy' => 'ivan.laguda',

        ]);
        DB::table('g59_addbudget_requests')->insert([
            'request_code' => "RC". uniqid(),
            'request_name' => 'New Server',
            'request_amount' => '4000',
            'request_category' => 'C3',
            'request_type' => 'T2',
            'request_department' => 1003,
            'request_optional' => 'N',
            'request_period' => 'Q3',
            'request_date' => '2023-12-23',
            'request_projectDetails' => 3,
            // 'request_historicalData',
            // 'request_riskFactorsAndContingencies',
            // 'request_impactOnOperations',
            // 'request_alignmentWithObjectives',
            // 'request_alternativesConsidered',
            // 'request_supportingDocumentation',
            // 'request_assumptionsAndMethodology',
            'request_actualSpending' => '6000',
            'request_justification' => 'Unexpected increase in server costs',
            'request_status' => 'S1',
            'request_approvedBy' => 'jasonryan.odvina',
            'request_approvedDate' => '2023-10-03',
            'request_approvedAmount' => '4000',
            'created_at' => now(),
            'updated_at' => now(),

            'request_createdBy' => 'jayson.azucena',

        ]);



    }
}
