<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        // $categories = Category::latest()->take(5);
        // $sub_categories = SubCategory::latest()->get();
        // $child_categories = ChildCategory::latest()->get();

        // $categories = Category::with('sub_categories', 'sub_categories.child_categories')->latest('id')->get();
        $sliders = Slider::where('status', 1)->get();
        $all_products = Product::where('status', 1)->orderBy('id', 'DESC')->limit(10)->get();
        $featured_products = Product::where('status', 1)->where('featured', 1)->latest('id')->limit(6)->get();
        $hot_products = Product::where('status', 1)->where('hot_deals', 1)->latest('id')->limit(6)->get();
        $cat_products = Category::latest('id')->get();
        
        return view('frontend.index', compact(['sliders', 'all_products', 'cat_products', 'featured_products', 'hot_products']));
    }

    public function productDetails(Product $product)
    {
        // return ($product);
        return view('frontend.product-details', compact('product'));
    }

        /// Product View With Ajax
	public function ProductViewAjax($id){
		$product = Product::with('category','brand')->findOrFail($id);

		$color = $product->product_color_en;
		$product_color = explode(',', $color);

		$size = $product->product_size_en;
		$product_size = explode(',', $size);

		return response()->json(array(
			'product' => $product,
			'color' => $product_color,
			'size' => $product_size,

		));

	} // end method 


}
