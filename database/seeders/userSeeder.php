<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class userSeeder extends Seeder
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
            'first_name' => 'Bala',
            'last_name' => 'SP',
            'user_name' => 'bala',
            'email' => 'balasubramaniam@gmail.com',
            'mobile' => '1234567890',
            'password' => Hash::make('12345678'),
            'user_role' => 'admin',

        ]);
    }
}
