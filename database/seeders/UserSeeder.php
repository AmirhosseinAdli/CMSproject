<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
            'name' => 'admin',
            'email' => 'admin@example.com',
            'mobile' => '09128154722',
            'password' => Hash::make('123456'),
        ])->assignRole('admin');
        User::factory()->count(20)->create()->each(function ($user){
            $user->assignRole('user');
        });
    }
}
