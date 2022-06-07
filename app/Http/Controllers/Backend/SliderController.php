<?php

namespace App\Http\Controllers\Backend;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::latest()->get();

        return view('backend.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'slider_image' => 'required|image',
        ]);
        $slider = Slider::create([
            'slider_image' => 'image.png',
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'status' => $request->status,
        ]);
        

        if($request->hasFile('slider_image')){
                $file = $request->file('slider_image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/slider/', $filename);
                $slider->slider_image = $filename;
                $slider->save();
        }
        
        return redirect()->route('admin.slider.index')->with('message', 'A slide added successfully');
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
    public function edit(Slider $slider)
    {
        return view('backend.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        // $this->validate($request, [
        //     'slider' => 'required',
        //     'brand_name_bn' => 'required',
        // ]);
        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->status = $request->status;

        if($request->hasFile('slider_image')){
                $destination = 'uploads/slider/'.$slider->slider_image;
                if(File::exists($destination)){
                    File::delete($destination);
                }
                $file = $request->file('slider_image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/slider/', $filename);
                $slider->slider_image = $filename; 
                $slider->save();      
        }

        $slider->update();
        return redirect()->route('admin.slider.index')->with('message', 'Your slider edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        if($slider){
            $destination = 'uploads/slider/'.$slider->brand_image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $slider->delete();

            return redirect()->route('admin.slider.index')->with('message', 'slide deleted successfully');
        }
    }
}
