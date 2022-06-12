<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\ChildCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->name;
        $image = "uploads/product/thumbnail/p".rand(1,30).".jpg";
        return [
            'product_name_en' => $name,
            'product_name_bn' => $name,
            'product_slug_en' => Str::slug($name),
            'product_slug_bn' => Str::slug($name),
            'brand_id' => Brand::inRandomOrder()->value('id'),
            'category_id' => Category::inRandomOrder()->value('id'),
            'sub_category_id' => SubCategory::inRandomOrder()->value('id'),
            'child_category_id' => ChildCategory::inRandomOrder()->value('id'),
            'product_code' => $this->faker->unique()->text(10),
            'product_qty' => rand(0, 1000),
            'product_tags_en' => Arr::random(['car', 'food', 'water', 'milk', 'cream', 'banana', 'apple']),
            'product_tags_bn' => Arr::random(['car', 'food', 'water', 'milk', 'cream', 'banana', 'apple']),
            'product_size_en' => Arr::random(['S', 'M', 'L', 'XL', 'XXL', 'SM', 'MS']),
            'product_size_bn' => Arr::random(['S', 'M', 'L', 'XL', 'XXL', 'SM', 'MS']),
            'product_color_en' => Arr::random(['red', 'green', 'black', 'white', 'pink', 'yellow', 'skyblue']),
            'product_color_bn' => Arr::random(['red', 'green', 'black', 'white', 'pink', 'yellow', 'skyblue']),
            'regular_price' => rand(100, 1000),
            'selling_price' => rand(80, 800),
            'short_descp_en' => $this->faker->text,
            'short_descp_bn' => $this->faker->text,
            'long_descp_en' => $this->faker->paragraph,
            'long_descp_bn' => $this->faker->paragraph,
            'product_thambnail' => $image,
            'hot_deals' => rand(0,1),
            'featured' => rand(0,1),
            'special_offer' => rand(0,1),
            'special_deals' => rand(0,1),
            'status' => rand(0,1),
        ];
    }
}
