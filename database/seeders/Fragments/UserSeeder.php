<?php

namespace Database\Seeders\Fragments;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('g59_users')->insert([

            'first_name' => 'Super Admin',
            'last_name' => ' ',
            'email' => 'auth@rkive.com',
            'username' => 'auth',
            'password' => bcrypt('auth'),
            'userpassword' => 'auth',
            'role_code' => '102',
            'department_code' => '1001',
            'profile' => 'uploads/category/profile\65fc2dd52f3e9.png',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('g59_users')->insert([

            'first_name' => 'Rkive',
            'last_name' => 'Developer',
            'email' => 'dev@rkive.com',
            'username' => 'dev',
            'password' => bcrypt('dev'),
            'userpassword' => 'dev',
            'role_code' => '101',
            'department_code' => '1001',
            'profile' => 'uploads/category/profile\65fc2dd52f3e9.png',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('g59_users')->insert([

            'first_name' => 'John Rey',
            'last_name' => 'Miranda',
            'email' => 'johnrey.miranda@rkive.com',
            'username' => 'johnrey.miranda',
            'password' => bcrypt('admin'),
            'userpassword' => 'admin',
            'role_code' => '102',
            'department_code' => '1001',
            'profile' => 'uploads/category/profile\65fc2ae9a622e.jpg',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('g59_users')->insert([

            'first_name' => 'Jason Ryan',
            'last_name' => 'Odvina',
            'email' => 'jasonryan.odvina@rkive.com',
            'username' => 'jasonryan.odvina',
            'password' => bcrypt('user'),
            'userpassword' => 'user',
            'role_code' => '103',
            'department_code' => '1002',
            'profile' => 'uploads/category/profile\65fc2d244cbf5.jpg',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('g59_users')->insert([

            'first_name' => 'Jonas',
            'last_name' => 'Pelicia',
            'email' => 'jonas.pelicia@rkive.com',
            'username' => 'jonas.pelicia',
            'password' => bcrypt('jonas'),
            'userpassword' => 'jonas',
            'role_code' => '103',
            'department_code' => '1003',
            'profile' => 'uploads/category/profile\661afeb7de069.jpg',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('g59_users')->insert([

            'first_name' => 'Ivan',
            'last_name' => 'Laguda',
            'email' => 'ivan.laguda@rkive.com',
            'username' => 'ivan.laguda',
            'password' => bcrypt('ivan'),
            'userpassword' => 'ivan',
            'role_code' => '103',
            'department_code' => '1004',
            'profile' => 'uploads/category/profile\661afec95dead.png',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('g59_users')->insert([

            'first_name' => 'Jayson',
            'last_name' => 'Azucena',
            'email' => 'jayson.azucena@rkive.com',
            'username' => 'jayson.azucena',
            'password' => bcrypt('jayson'),
            'userpassword' => 'jayson',
            'role_code' => '103',
            'department_code' => '1005',
            'profile' => 'uploads/category/profile\661afede3064d.jpg',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
