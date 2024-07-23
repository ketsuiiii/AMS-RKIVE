<?php

namespace Database\Seeders\Fragments;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class BudgetTrackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Define the track IDs
        $trackIds = [1, 2, 3, 4, 5];

        foreach ($trackIds as $trackId) {
            $budgetRequest = DB::table('g59_budget_requests')->where('id', $trackId)->first();

            $trackDepartment = $budgetRequest->budget_department;
            $trackCategory = $budgetRequest->budget_category;
            $trackAmount = $budgetRequest->budget_approvedAmount;
            $trackDate = $faker->dateTimeBetween($startDate = '-1 year', $endDate = 'now')->format('Y-m-d');

            DB::table('g59_budget_track')->insert([
                'track_id' => $trackId,
                'track_department' => $trackDepartment,
                'track_category' => $trackCategory,
                'track_amount' => $trackAmount,
                'track_date' => $trackDate,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
