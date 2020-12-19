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
//        (new RolePermissionSeeder())->run();
        $this->call([
            RolePermissionSeeder::class,
            UserSeeder::class,
            ImageSeeder::class,
            TagSeeder::class,
            CategorySeeder::class,
            PostSeeder::class
        ]);
//        (new UserSeeder())->run();
//        (new ImageSeeder())->run();
//        (new TagSeeder())->run();
//        (new CategorySeeder())->run();
//        (new PostSeeder())->run();
    }
}
