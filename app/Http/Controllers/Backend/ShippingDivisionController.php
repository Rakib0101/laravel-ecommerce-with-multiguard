<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\ShippingDivision;
use App\Http\Controllers\Controller;
use App\Models\ShippingShippingDivision;

class ShippingDivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $divisions= ShippingDivision::latest()->get();
        return view('backend.division.index', compact('divisions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.division.create');
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
            'division_name' => 'required',
        ]);
        $division = ShippingDivision::create([
            'division_name' => $request->division_name,
        ]);
        
        return redirect()->route('admin.division.index')->with('message', 'A new division added successfully');
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
    public function edit(ShippingDivision $division)
    {
        return view('backend.division.edit', compact('division'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShippingDivision $division)
    {
        $this->validate($request, [
            'division_name' => 'required',
        ]);
        $division->division_name = $request->division_name;

        $division->update();
        return redirect()->route('admin.division.index')->with('message', 'Your division edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShippingDivision $division)
    {
        if($division){
            $division->delete();
            return redirect()->route('admin.division.index')->with('message', 'division deleted successfully');
        }
    }

    public function GetDistrict($division_id){
         
        $district = District::where('division_id',$division_id)->orderBy('district_name','ASC')->get();
        // return json_encode($subcat);
        return response()->json($district);
    }

    public function GetChildCategory($sub_category_id){

        $subsubcat = ChildCategory::where('sub_category_id',$sub_category_id)->orderBy('child_category_name_en','ASC')->get();
        return response()->json($subsubcat);
    }

}
