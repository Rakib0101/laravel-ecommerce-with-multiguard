<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->word(4);
        $image = "https://picsum.photos/id/".rand(30, 100)."/700/600.jpg";
        return [
            'title' => $name,
            'sub_title' => $this->faker->unique()->word(3),
            'description' => $this->faker->unique()->sentence,
            'button_text' => 'Shop Now',
            'button_link' => 'https://github.com/Rakib0101',
            'image' => $image,
            'status' => rand(0,1),
        ];
    }
}
