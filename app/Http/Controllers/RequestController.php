<?php

namespace App\Http\Controllers;

use App\Enums\LeaveRequestStatus;
use App\Http\Requests\StoreRequestRequest;
use App\Http\Requests\UpdateRequestRequest;
use App\Models\LeaveRequest;
use App\Models\Request;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Request::all()->toJson();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequestRequest $request)
    {
        $requestable = '';
        switch ($request->type) {
            case 'leave':
                $requestable = LeaveRequest::create([
                    'dates' => $request->dates,
                    'leave_type' => $request->type,
                    'status' => LeaveRequestStatus::Pending,
                    'description' => $request->description
                ]);
                break;
            case 'optional-leave':

                //'min_days' => $request->min_days,
                //'max_days' => $request->max_days,
                //'from_date' =>
                break;
            case 'overtime':
                break;
        }

        $req = Request::create([
            'employee_id' => $request->employee_id,
            'requestable_id' => $requestable->id,
            'requestable_type' => $requestable::class
        ]);

        return $req->requestable->toJson();

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequestRequest $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
    }
}
