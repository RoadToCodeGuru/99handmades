<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

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
            'name' => 'Shoon Lei Yati',
            'email' => 'shoonleyati2017@gmail.com',
            'password' => Hash::make('Lovelyshoon99'),
        ]);
    }
}
