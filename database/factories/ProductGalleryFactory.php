<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductGalleryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $image = "uploads/product/thumbnail/p".rand(1,30).".jpg";
        return [
            'product_id' =>  Product::inRandomOrder()->value('id'),
            'photo_name' => $image,
        ];
    }
}
