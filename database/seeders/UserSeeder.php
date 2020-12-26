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
            'name' => 'super-admin',
            'email' => 'super-admin@gmail.com',
            'mobile' => 'super-admin',
            'password' => Hash::make('123456'),
        ])->assignRole('super-admin');
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'mobile' => 'admin',
            'password' => Hash::make('123456'),
        ])->assignRole('admin');
        User::create([
            'name' => 'author',
            'email' => 'author@gmail.com',
            'mobile' => 'author',
            'password' => Hash::make('123456'),
        ])->assignRole('author');
        User::create([
            'name' => 'publisher',
            'email' => 'publisher@gmail.com',
            'mobile' => 'publisher',
            'password' => Hash::make('123456'),
        ])->assignRole('publisher');
        User::create([
            'name' => 'guest',
            'email' => 'guest@gmail.com',
            'mobile' => 'guest',
            'password' => Hash::make('123456'),
        ])->assignRole('guest');
        User::factory()->count(20)->create()->each(function ($user){
            $user->assignRole('guest');
        });
    }
}
