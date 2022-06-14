<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\ShippingDistrict;
use App\Models\ShippingDivision;
use App\Http\Controllers\Controller;

class ShippingDistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $districts= ShippingDistrict::latest()->get();
        return view('backend.district.index', compact('districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = ShippingDivision::latest()->get();
        return view('backend.district.create', compact('divisions'));
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
            'district_name' => 'required',
            'division_id' => 'required',
        ]);
        $district = ShippingDistrict::create([
            'district_name' => $request->district_name,
            'division_id' => $request->division_id,
        ]);
        
        return redirect()->route('admin.district.index')->with('message', 'A new district added successfully');
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
    public function edit(ShippingDistrict $district)
    {
        $divisions = ShippingDivision::latest()->get();
        return view('backend.district.edit', compact(['district', 'divisions']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShippingDistrict $district)
    {
        $this->validate($request, [
            'district_name' => 'required',
            'division_id' => 'required',
        ]);
        $district->district_name = $request->district_name;

        $district->update();
        return redirect()->route('admin.district.index')->with('message', 'Your district edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShippingDistrict $district)
    {
        if($district){
            $district->delete();
            return redirect()->route('admin.district.index')->with('message', 'district deleted successfully');
        }
    }
}
