<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use voku\helper\ASCII;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $arr = [
            \App\Models\Post::class,
            \App\Models\Category::class,
            ];
        return [
            'title' => $this->faker->word,
            'alt' => $this->faker->sentence,
            'path' => $this->faker->image( 'storage/app/public'),
//            'imageable_id' => rand(1,2050),
//            'imageable_type' => $arr[rand(0,1)],
        ];
    }
}
