<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->name();
        return [
            'category_id' => Category::inRandomOrder()->value('id'),
            'sub_category_name_en' => $name,
            'sub_category_slug_en' => Str::slug($name),
            'sub_category_name_bn' => $name,
            'sub_category_slug_bn' => Str::slug($name),
            'sub_category_image' => $this->faker->imageUrl,
        ];
    }
}
