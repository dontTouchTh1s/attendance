<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\Request;
use App\Http\Requests\StoreRequestRequest;
use App\Http\Requests\UpdateRequestRequest;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequestRequest $request)
    {
        $requestable = '';
        switch ($request->type){
            case 'leave':
                $requestable = LeaveRequest::create([
                    'dates' => $request->dates,
                    'type' => $request->type,
                    'accepted' => \LeaveAccepted::Pending,
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

        Request::create([
            'employee_id' => $request->employee_id,
            'requestable_id' => $requestable->id,
            'requestable_type' => $requestable::class
        ]);

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
