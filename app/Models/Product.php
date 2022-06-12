<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use App\Models\ProductGallery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded= [];

    public function product_gallery()
    {
        return $this->belongsTo(ProductGallery::class, 'product_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function sub_subcategory()
    {
        return $this->belongsTo(ChildCategory::class, 'sub_subcategory_id');
    }

    public function product_galleries()
    {
        return $this->hasMany(ProductGallery::class, 'product_id', 'id');
    }
}
