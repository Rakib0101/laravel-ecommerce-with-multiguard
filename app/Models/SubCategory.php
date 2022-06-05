<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'sub_category_name_en',
        'sub_category_name_bn',
        'sub_category_slug_en',
        'sub_category_slug_bn',
        'sub_category_image',
    ];
}
