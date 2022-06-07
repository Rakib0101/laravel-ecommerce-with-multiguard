<?php

namespace App\Http\Controllers\Backend;

use Image;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Models\ProductGallery;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('backend.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->get();
		    $brands = Brand::latest()->get();
		    return view('backend.product.create',compact(['categories','brands']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $product = Product::create([
      	'brand_id' => $request->brand_id,
      	'category_id' => $request->category_id,
      	'sub_category_id' => $request->sub_category_id,
      	'child_category_id' => $request->child_category_id,
      	'product_name_en' => $request->product_name_en,
      	'product_name_bn' => $request->product_name_bn,
      	'product_slug_en' =>  Str::slug($request->product_slug_en, '-'),
      	'product_slug_bn' => Str::slug($request->product_slug_bn, '-'),
      	'product_code' => $request->product_code,

      	'product_qty' => $request->product_qty,
      	'product_tags_en' => $request->product_tags_en,
      	'product_tags_bn' => $request->product_tags_bn,
      	'product_size_en' => $request->product_size_en,
      	'product_size_bn' => $request->product_size_bn,
      	'product_color_en' => $request->product_color_en,
      	'product_color_bn' => $request->product_color_bn,

      	'selling_price' => $request->selling_price,
      	'regular_price' => $request->regular_price,
      	'short_descp_en' => $request->short_descp_en,
      	'short_descp_bn' => $request->short_descp_bn,
      	'long_descp_en' => $request->long_descp_en,
      	'long_descp_bn' => $request->long_descp_bn,
        'product_thambnail' => 'image.png',
      	'hot_deals' => $request->hot_deals,
      	'featured' => $request->featured,
      	'special_offer' => $request->special_offer,
      	'special_deals' => $request->special_deals,

      	'status' => $request->status,
      	'created_at' => Carbon::now(),   	 
        ]);

        if($request->hasFile('product_thambnail')){
                $file = $request->file('product_thambnail');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/product/thumbnail/', $filename);
                $product->product_thambnail = $filename;
                $product->save();
        }

        


      ////////// Multiple Image Upload Start ///////////

      $images = $request->file('product_galleries');
      foreach ($images as $img) {
      	$make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
    	Image::make($img)->resize(917,1000)->save('uploads/product/gallery/'.$make_name);
    	$uploadPath = 'uploads/product/gallery/'.$make_name;

    	ProductGallery::insert([

    		'product_id' => $product->id,
    		'photo_name' => $uploadPath,
    		'created_at' => Carbon::now(), 

    	]);

      }

      ////////// Een Multiple Image Upload Start ///////////


        return redirect()->route('admin.product.index')->with('message', 'A new product added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::latest()->get();
        $sub_categories = SubCategory::latest()->get();
        $child_categories = ChildCategory::latest()->get();
		    $brands = Brand::latest()->get();
        $multiImgs = ProductGallery::where('product_id', $product->id)->get();
		    return view('backend.product.edit',compact(['categories', 'sub_categories', 'child_categories', 'product', 'multiImgs', 'brands']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->brand_id = $request->brand_id;
      	$product->category_id = $request->category_id;
      	$product->sub_category_id = $request->sub_category_id;
      	$product->child_category_id = $request->child_category_id;
      	$product->product_name_en = $request->product_name_en;
      	$product->product_name_bn = $request->product_name_bn;
      	$product->product_slug_en =  Str::slug($request->product_slug_en, '-');
      	$product->product_slug_bn = Str::slug($request->product_slug_bn, '-');
      	$product->product_code = $request->product_code;

      	$product->product_tags_en = $request->product_tags_en;
      	$product->product_qty = $request->product_qty;
      	$product->product_tags_bn = $request->product_tags_bn;
      	$product->product_size_en = $request->product_size_en;
      	$product->product_size_bn = $request->product_size_bn;
      	$product->product_color_en = $request->product_color_en;
      	$product->product_color_bn = $request->product_color_bn;

      	$product->selling_price = $request->selling_price;
      	$product->regular_price = $request->regular_price;
      	$product->short_descp_en = $request->short_descp_en;
      	$product->short_descp_bn = $request->short_descp_bn;
      	$product->long_descp_en = $request->long_descp_en;
      	$product->long_descp_bn = $request->long_descp_bn;
        $product->product_thambnail = 'image.png';
      	$product->hot_deals = $request->hot_deals;
      	$product->featured = $request->featured;
      	$product->special_offer = $request->special_offer;
      	$product->special_deals = $request->special_deals;

      	$product->status = $request->status;

        $product->save();

        return redirect()->back()->with('message', 'This product updated successfully');

    }
    public function destroy(Product $product)
    {
        if($product){
            $destination = 'uploads/product/'.$product->product_thumbnail;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $product->delete();

            return redirect()->route('admin.product.index')->with('message', 'product deleted successfully');
        }
    }

  }
