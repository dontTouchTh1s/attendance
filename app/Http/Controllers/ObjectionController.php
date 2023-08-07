<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreObjectionRequest;
use App\Http\Requests\UpdateObjectionRequest;
use App\Http\Resources\ObjectionResource;
use App\Http\Resources\UserObjectionResource;
use App\Models\Objection;


class ObjectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ObjectionResource::collection(Objection::all()->where('reviewed', false));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreObjectionRequest $request)
    {
        Objection::create($request->validated());

        return response('objection created', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Objection $objection)
    {
        //
    }

    public function user()
    {
        $attendanceLeaves = \Auth::user()->employee->attendanceLeaves;
        $objections = [];
        foreach ($attendanceLeaves as $attendanceLeave) {
            $objectionCollection = $attendanceLeave->objections;
            foreach ($objectionCollection as $objection) {
                $objections[] = ($objection);
            }
        }
        return UserObjectionResource::collection($objections);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateObjectionRequest $request, Objection $objection)
    {
        $objection->fill($request->validated());
        $objection->reviewed = true;
        $objection->save();
        return response('successful', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Objection $objection)
    {
        //
    }
}
