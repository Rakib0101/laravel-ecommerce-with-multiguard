<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\ShippingState;
use App\Models\ShippingDistrict;
use App\Models\ShippingDivision;
use App\Http\Controllers\Controller;

class ShippingStateController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states= ShippingState::latest()->get();
        return view('backend.state.index', compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = ShippingDivision::latest()->get();
        $districts = ShippingDistrict::latest()->get();
        return view('backend.state.create', compact(['divisions', 'districts']));
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
            'state_name' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
        ]);
        $state = ShippingState::create([
            'state_name' => $request->state_name,
            'division_id' => $request->division_id,
            'district_id' => $request->division_id,
        ]);
        
        return redirect()->route('admin.state.index')->with('message', 'A new state added successfully');
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
    public function edit(ShippingState $state)
    {
        $divisions = ShippingDivision::latest()->get();
        $districts = Shippingdistrict::latest()->get();
        return view('backend.state.edit', compact(['state', 'districts','divisions']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShippingState $state)
    {
        $this->validate($request, [
            'state_name' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
        ]);
        $state->state_name = $request->state_name;

        $state->update();
        return redirect()->route('admin.state.index')->with('message', 'Your state edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShippingState $state)
    {
        if($state){
            $state->delete();
            return redirect()->route('admin.state.index')->with('message', 'state deleted successfully');
        }
    }
}
