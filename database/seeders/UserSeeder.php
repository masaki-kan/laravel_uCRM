<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'adminadmin@gmail.com',
                'password' => Hash::make('adminadmin'),
            ],
            [
                'name' => 'test1',
                'email' => 'test1test1@gmail.com',
                'password' => Hash::make('test1test1'),
            ],
        ]);
    }
}
