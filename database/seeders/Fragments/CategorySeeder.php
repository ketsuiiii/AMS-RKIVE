<?php

namespace Database\Seeders\Fragments;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('g59_categories')->insert([
            'category_code' => 'C1',
            'category_name' => 'Training',
        ]);

        DB::table('g59_categories')->insert([
            'category_code' => 'C2',
            'category_name' => 'Support',
        ]);

        DB::table('g59_categories')->insert([
            'category_code' => 'C3',
            'category_name' => 'Hardware',
        ]);

        DB::table('g59_categories')->insert([
            'category_code' => 'C4',
            'category_name' => 'Software',
        ]);

        DB::table('g59_categories')->insert([
            'category_code' => 'C5',
            'category_name' => 'Conference',
        ]);

        DB::table('g59_categories')->insert([
            'category_code' => 'C6',
            'category_name' => 'Meeting',
        ]);

        DB::table('g59_categories')->insert([
            'category_code' => 'C7',
            'category_name' => 'Travel',
        ]);

        DB::table('g59_categories')->insert([
            'category_code' => 'C8',
            'category_name' => 'Expenses',
        ]);

        DB::table('g59_categories')->insert([
            'category_code' => 'C9',
            'category_name' => 'Other',
        ]);

    }
}
