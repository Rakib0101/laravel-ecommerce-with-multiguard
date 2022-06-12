<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
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
            'brand_name_en' => $name,
            'brand_slug_en' => Str::slug($name),
            'brand_name_bn' => $name,
            'brand_slug_bn' => Str::slug($name),
            'brand_image' => $this->faker->imageUrl,
        ];
    }
}
