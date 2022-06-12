<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChildCategoryFactory extends Factory
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
            'sub_category_id' => SubCategory::inRandomOrder()->value('id'),
            'child_category_name_en' => $name,
            'child_category_slug_en' => Str::slug($name),
            'child_category_name_bn' => $name,
            'child_category_slug_bn' => Str::slug($name),
            'child_category_image' => $this->faker->imageUrl,
        ];
    }
}
