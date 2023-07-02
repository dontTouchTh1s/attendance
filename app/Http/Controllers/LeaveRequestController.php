<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateLeaveRequestRequest;
use App\Models\LeaveRequest;
use Illuminate\Http\Response;

class LeaveRequestController extends Controller
{
    public function index()
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLeaveRequestRequest $request): Response
    {
        $requestable = LeaveRequest::findOrFail($request->id)->first();
        $values = array_filter($request->all());
        $requestable->fill($values);
        $requestable->save();
        return response($requestable);
    }


}
