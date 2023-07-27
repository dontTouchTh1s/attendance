<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupPoliciesRequest;
use App\Http\Requests\UpdateGroupPoliciesRequest;
use App\Models\GroupPolicy;

class GroupPoliciesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return GroupPolicy::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGroupPoliciesRequest $request)
    {
        $data = $request->validated();
        $gp = new GroupPolicy();
        $gp->fill($data)->save();
        return response('', 201);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GroupPolicy $groupPolicies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGroupPoliciesRequest $request, GroupPolicy $groupPolicies)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GroupPolicy $groupPolicies)
    {
        //
    }
}
