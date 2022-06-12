<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
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
            'category_name_en' => $name,
            'category_slug_en' => Str::slug($name),
            'category_name_bn' => $name,
            'category_slug_bn' => Str::slug($name),
            'category_image' => $this->faker->imageUrl,
        ];
    }
}
