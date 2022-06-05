<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories= Category::latest()->get();
        return view('backend.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.create');
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
            'category_name_en' => 'required',
            'category_name_bn' => 'required',
            'category_image' => 'required|image',
        ]);
        $category = Category::create([
            'category_name_en' => $request->category_name_en,
            'category_slug_en' => Str::slug($request->category_name_en, '-'),
            'category_name_bn' => $request->category_name_bn,
            'category_slug_bn' => Str::slug($request->category_name_bn, '-'),
            'category_image' => 'image.png',
        ]);
        

        if($request->hasFile('category_image')){
                $file = $request->file('category_image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/category/', $filename);
                $category->category_image = $filename;
                $category->save();
        }
        
        return redirect()->route('admin.category.index')->with('message', 'A new category added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('backend.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'category_name_en' => 'required',
            'category_name_bn' => 'required',
        ]);
        $category->category_name_en = $request->category_name_en;
        $category->category_slug_en = Str::slug($request->category_name_en, '-');
        $category->category_name_bn = $request->category_name_bn;
        $category->category_slug_bn = Str::slug($request->category_name_bn, '-');

        if($request->hasFile('category_image')){
                $destination = 'uploads/category/'.$category->category_image;
                if(File::exists($destination)){
                    File::delete($destination);
                }
                $file = $request->file('category_image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/category/', $filename);
                $category->category_image = $filename;       
        }

        $category->update();
        return redirect()->route('admin.category.index')->with('message', 'Your brand edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category){
            $destination = 'uploads/category/'.$category->category_image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $category->delete();

            return redirect()->route('admin.category.index')->with('message', 'category deleted successfully');
        }
    }
}
