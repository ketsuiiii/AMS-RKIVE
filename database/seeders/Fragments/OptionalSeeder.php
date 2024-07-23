<?php

namespace Database\Seeders\Fragments;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('g59_optional')->insert([
            'optional_code' => 'Y',
            'optional_name' => 'Yes',
        ]);

        DB::table('g59_optional')->insert([
            'optional_code' => 'N',
            'optional_name' => 'No',
        ]);
    }
}
