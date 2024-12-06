<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create([
            'name' => 'Ahmed Mahmoud',
            'email' => 'ahmedmahmoud@gmail.com',
            'phone_number' => '011518283',
            'password' => Hash::make('123')
        ]);

        DB::table('users')->insert([
            'name' => 'Ibrahim Mahmoud',
            'email' => 'ibrahim@gmail.com',
            'phone_number' => '012846471',
            'password' => Hash::make('1dddd23')
        ]);
    }
}
