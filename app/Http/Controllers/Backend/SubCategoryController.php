<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_categories= SubCategory::latest()->get();
        return view('backend.sub_category.index', compact('sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.sub_category.create', compact('categories'));
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
            'sub_category_name_en' => 'required',
            'sub_category_name_bn' => 'required',
        ]);
        $sub_category = SubCategory::create([
            'category_id' => $request->category_id,
            'sub_category_name_en' => $request->sub_category_name_en,
            'sub_category_slug_en' => Str::slug($request->sub_category_name_en, '-'),
            'sub_category_name_bn' => $request->sub_category_name_bn,
            'sub_category_slug_bn' => Str::slug($request->sub_category_name_bn, '-'),
            'sub_category_image' => 'image.png',
        ]);
        

        if($request->hasFile('sub_category_image')){
                $file = $request->file('sub_category_image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/sub_category/', $filename);
                $sub_category->sub_category_image = $filename;
                $sub_category->save();
        }
        
        return redirect()->route('admin.sub_category.index')->with('message', 'A new sub-category added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $sub_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $sub_category)
    {
        $categories = Category::all();
        return view('backend.sub_category.edit', compact(['sub_category', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $sub_category)
    {
        $sub_category->category_id = $request->category_id;
        $sub_category->sub_category_name_en = $request->sub_category_name_en;
        $sub_category->sub_category_slug_en = Str::slug($request->sub_category_name_en, '-');
        $sub_category->sub_category_name_bn = $request->sub_category_name_bn;
        $sub_category->sub_category_slug_bn = Str::slug($request->sub_category_name_bn, '-');

        if($request->hasFile('sub_category_image')){
                $destination = 'uploads/sub_category/'.$sub_category->sub_category_image;
                if(File::exists($destination)){
                    File::delete($destination);
                }
                $file = $request->file('sub_category_image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/sub_category/', $filename);
                $sub_category->sub_category_image = $filename;       
        }

        $sub_category->update();
        return redirect()->route('admin.sub_category.index')->with('message', 'Your sub category edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $sub_category)
    {
        if($sub_category){
            $destination = 'uploads/sub_category/'.$sub_category->sub_category_image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $sub_category->delete();

            return redirect()->route('admin.sub_category.index')->with('message', 'category deleted successfully');
        }
    }

    public function GetSubCategory($category_id){
         
        $subcat = SubCategory::where('category_id',$category_id)->orderBy('sub_category_name_en','ASC')->get();
        // return json_encode($subcat);
        return response()->json($subcat);
    }

    public function GetChildCategory($sub_category_id){

        $subsubcat = ChildCategory::where('sub_category_id',$sub_category_id)->orderBy('child_category_name_en','ASC')->get();
        return response()->json($subsubcat);
    }

}

