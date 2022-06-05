<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Image;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;


class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::latest()->get();
        return view('backend.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        // validation
        $this->validate($request, [
            'brand_name_en' => 'required',
            'brand_name_bn' => 'required',
            'brand_image' => 'required|image',
        ]);
        $brand = Brand::create([
            'brand_name_en' => $request->brand_name_en,
            'brand_slug_en' => Str::slug($request->brand_name_en, '-'),
            'brand_name_bn' => $request->brand_name_bn,
            'brand_slug_bn' => Str::slug($request->brand_name_bn, '-'),
            'brand_image' => 'image.png',
        ]);
        

        if($request->hasFile('brand_image')){
                $file = $request->file('brand_image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/brand/', $filename);
                $brand->brand_image = $filename;
                $brand->save();
        }
        
        return redirect()->route('admin.brands.index')->with('message', 'A new brand added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('backend.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $this->validate($request, [
            'brand_name_en' => 'required',
            'brand_name_bn' => 'required',
        ]);
        $brand->brand_name_en = $request->brand_name_en;
        $brand->brand_slug_en = Str::slug($request->brand_name_en, '-');
        $brand->brand_name_bn = $request->brand_name_bn;
        $brand->brand_slug_bn = Str::slug($request->brand_name_bn, '-');

        if($request->hasFile('brand_image')){
                $destination = 'uploads/brand/'.$brand->brand_image;
                if(File::exists($destination)){
                    File::delete($destination);
                }
                $file = $request->file('brand_image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/brand/', $filename);
                $brand->brand_image = $filename;       
        }

        $brand->update();
        return redirect()->route('admin.brands.index')->with('message', 'Your brand edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        if($brand){
            $destination = 'uploads/brand/'.$brand->brand_image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $brand->delete();

            return redirect()->route('admin.brands.index')->with('message', 'brand deleted successfully');
        }
    }
}

