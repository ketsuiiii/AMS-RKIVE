<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\Fragments\AddBdgtRqstSeeder;
use Database\Seeders\Fragments\BdgtRqstSeeder;
use Database\Seeders\Fragments\BudgetTrackSeeder;
use Database\Seeders\Fragments\CategorySeeder;
use Database\Seeders\Fragments\DepartmentSeeder;
use Database\Seeders\Fragments\OldSeeder;
use Database\Seeders\Fragments\PeriodSeeder;
use Database\Seeders\Fragments\OptionalSeeder;
use Database\Seeders\Fragments\PlanCategorySeeder;
use Database\Seeders\Fragments\RoleSeeder;
use Database\Seeders\Fragments\StatusSeeder;
use Database\Seeders\Fragments\TypeSeeder;
use Database\Seeders\Fragments\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            DepartmentSeeder::class,
            UserSeeder::class,
        ]);

        $this->call([
            CategorySeeder::class,
            TypeSeeder::class,
            StatusSeeder::class,
            PlanCategorySeeder::class,
        ]);

        $this->call([
            PeriodSeeder::class,
            OptionalSeeder::class,
            BdgtRqstSeeder::class,
            AddBdgtRqstSeeder::class,
            BudgetTrackSeeder::class,
        ]);

        $this->call([
            OldSeeder::class,
        ]);
    }
}
