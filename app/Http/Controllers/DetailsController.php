<?php

namespace App\Http\Controllers;

use App\Models\Details;
use Illuminate\Http\Request;

class DetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = Details::get();
        return response()->json($details);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'details' => 'required',
            'price' => 'required'

        ]);


        $details = new Details();
        $details->name = $request['name'];
        $details->details = $request['details'];
        $details->price = $request['price'];
        $details->famprice = $request['famprice'];
        $details->category_id = $request['category_id'];
        $details->subcategory_id = $request['subcategory_id'];
        $details->save();
        return response()->json($details);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Details  $details
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $details = Details::findOrFail($id);
        return response()->json($details);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Details  $details
     * @return \Illuminate\Http\Response
     */
    public function edit(Details $details)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Details  $details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $details = Details::findOrFail($id);
        $details->price = $request->price;
        $details->famprice = $request->famprice;
        $details->save();
        return response()->json($details);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Details  $details
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $details = Details::findOrFail($id);
        $details->delete();
        return response()->json($details);
    }
}