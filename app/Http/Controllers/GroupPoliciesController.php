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
        GroupPolicy::create($request->validated());
        return response('', 201);
    }

    public function show(GroupPolicy $groupPolicy)
    {
        return response($groupPolicy);
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
