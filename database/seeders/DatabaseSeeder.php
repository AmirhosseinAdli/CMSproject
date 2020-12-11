<?php

namespace Database\Seeders;

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
        (new UserSeeder())->run();
        (new CategorySeeder())->run();
        (new TagSeeder())->run();
        (new PostSeeder())->run();
        (new ImageSeeder())->run();
    }
}
