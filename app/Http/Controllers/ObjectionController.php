<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreObjectionRequest;
use App\Http\Resources\ObjectionResource;
use App\Models\Objection;
use Illuminate\Http\Request;

class ObjectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ObjectionResource::collection(Objection::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreObjectionRequest $request)
    {
        $objection = new Objection();
        $objection->fill($request->validated())->save();
        return response('objection created', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Objection $objection)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Objection $objection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Objection $objection)
    {
        //
    }
}
