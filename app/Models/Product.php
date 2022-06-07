<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded= [];

    public function product_gallery()
    {
        return $this->belongsTo(ProductGallery::class, 'product_id', 'id');
    }
}
