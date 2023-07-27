<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkPlaceRequest;
use App\Models\WorkPlace;
use Illuminate\Http\Request;

class WorkPlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return WorkPlace::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkPlaceRequest $request)
    {
        WorkPlace::create([
            'lat' => $request->lat,
            'lng' => $request->lng,
            'radius' => $request->radius,
            'address' => $request->address,
            'name' => $request->name
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(WorkPlace $workPlace)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WorkPlace $workPlace)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkPlace $workPlace)
    {
        //
    }
}
