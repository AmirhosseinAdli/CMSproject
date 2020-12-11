<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->count(50)->create()
            ->each( function($category){
        Image::factory()->count(rand(0,1))->create(['imageable_id' => $category->id, 'imageable_type' => Category::class]);
    });
    }
}
