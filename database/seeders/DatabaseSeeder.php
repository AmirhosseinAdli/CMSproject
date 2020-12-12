<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        (new RolePermissionSeeder())->run();
        (new UserSeeder())->run();
        (new CategorySeeder())->run();
        (new TagSeeder())->run();
        (new PostSeeder())->run();
        (new ImageSeeder())->run();
    }
}
