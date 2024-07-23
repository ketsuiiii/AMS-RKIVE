<?php

namespace Database\Seeders\Fragments;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('g59_statuses')->insert([
            'status_code' => 'S1',
            'status_name' => 'Approved',
        ]);

        DB::table('g59_statuses')->insert([
            'status_code' => 'S2',
            'status_name' => 'Pending',
        ]);

        DB::table('g59_statuses')->insert([
            'status_code' => 'S3',
            'status_name' => 'Rejected',
        ]);

    }
}
