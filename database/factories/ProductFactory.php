<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->words(5,true);
        return [
            'name' => $name ,
            'slug' => Str::slug($name),
            'description' => $this->faker->sentence(15,true),
            'image' => $this->faker->imageUrl(600,600),
            'price' => $this->faker->randomFloat(1,1,499),
            'compare_price' => $this->faker->randomFloat(1,1,499),
            'category_id' => Category::inRandomOrder()->first()->id, // go to categories and re-arrange random this and give me first id
            'featured' => rand(0,1),
            'store_id' => Store::inRandomOrder()->first()->id,
        ];
    }
}
