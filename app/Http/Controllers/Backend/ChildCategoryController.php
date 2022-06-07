<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $child_categories= ChildCategory::latest()->get();
        return view('backend.child_category.index', compact('child_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $sub_categories = SubCategory::all();
        return view('backend.child_category.create', compact(['categories','sub_categories']));
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
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'child_category_name_en' => 'required',
            'child_category_name_bn' => 'required',
        ]);
        $child_category = ChildCategory::create([
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'child_category_name_en' => $request->child_category_name_en,
            'child_category_slug_en' => Str::slug($request->child_category_name_en, '-'),
            'child_category_name_bn' => $request->child_category_name_bn,
            'child_category_slug_bn' => Str::slug($request->child_category_name_bn, '-'),
            'child_category_image' => 'image.png',
        ]);
        

        if($request->hasFile('child_category_image')){
                $file = $request->file('child_category_image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/child_category/', $filename);
                $child_category->child_category_image = $filename;
                $child_category->save();
        }
        
        return redirect()->route('admin.child_category.index')->with('message', 'A new child-category added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChildCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function show(ChildCategory $child_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChildCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(ChildCategory $child_category)
    {
        $categories = Category::all();
        $sub_categories = SubCategory::all();
        return view('backend.child_category.edit', compact(['child_category', 'sub_categories', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChildCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChildCategory $child_category)
    {
        $child_category->category_id = $request->category_id;
        $child_category->sub_category_id = $request->sub_category_id;
        $child_category->child_category_name_en = $request->child_category_name_en;
        $child_category->child_category_slug_en = Str::slug($request->child_category_name_en, '-');
        $child_category->child_category_name_bn = $request->child_category_name_bn;
        $child_category->child_category_slug_bn = Str::slug($request->child_category_name_bn, '-');

        if($request->hasFile('child_category_image')){
                $destination = 'uploads/child_category/'.$child_category->child_category_image;
                if(File::exists($destination)){
                    File::delete($destination);
                }
                $file = $request->file('child_category_image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/child_category/', $filename);
                $child_category->child_category_image = $filename;       
        }

        $child_category->update();
        return redirect()->route('admin.child_category.index')->with('message', 'Your child category edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChildCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChildCategory $child_category)
    {
        return $child_category;
        if($child_category){
            $destination = 'uploads/child_category/'.$child_category->child_category_image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $child_category->delete();

            return redirect()->route('admin.child_category.index')->with('message', 'category deleted successfully');
        }
    }
}


