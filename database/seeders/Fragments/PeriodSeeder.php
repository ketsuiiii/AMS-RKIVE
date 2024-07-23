<?php

namespace Database\Seeders\Fragments;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('g59_periods')->insert([
            'periods' => 'quarterly',
            'period_code' => 'Q1',
            'period_name' => 'Quarter 1',
        ]);

        DB::table('g59_periods')->insert([
            'periods' => 'quarterly',
            'period_code' => 'Q2',
            'period_name' => 'Quarter 2',
        ]);

        DB::table('g59_periods')->insert([
            'periods' => 'quarterly',
            'period_code' => 'Q3',
            'period_name' => 'Quarter 3',
        ]);

        DB::table('g59_periods')->insert([
            'periods' => 'quarterly',
            'period_code' => 'Q4',
            'period_name' => 'Quarter 4',
        ]);

        DB::table('g59_periods')->insert([
            'periods' => 'annual',
            'period_code' => 'A1',
            'period_name' => 'Annual',
        ]);

        DB::table('g59_periods')->insert([
            'periods' => 'semi-annual',
            'period_code' => 'SA1',
            'period_name' => 'Semi-Annual 1',
        ]);

        DB::table('g59_periods')->insert([
            'periods' => 'semi-annual',
            'period_code' => 'SA2',
            'period_name' => 'Semi-Annual 2',
        ]);

    }
}
