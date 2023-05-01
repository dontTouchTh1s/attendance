<?php

namespace App\Http\Controllers;

use App\Enums\LeaveRequestStatus;
use App\Http\Requests\StoreRequestRequest;
use App\Http\Requests\UpdateRequestRequest;
use App\Models\LeaveRequest;
use App\Models\Request;
use Illuminate\Http\Response;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response(Request::all()->each(function ($req) {
            $req->requestable;
        }));
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreRequestRequest $request
     * @return Response
     */
    public function store(StoreRequestRequest $request): Response
    {
        $requestable = '';
        switch ($request->type) {
            case 'leave': //Creating leave request
                $requestable = LeaveRequest::create([
                    'dates' => $request->dates,
                    'leave_type' => $request->leave_type,
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
                //Create an OvertimeRequest
                break;
        }
        $req = Request::create([
            'employee_id' => $request->employee_id,
            'requestable_id' => $requestable->id,
            'requestable_type' => $requestable::class
        ]);
        $req->requestable;
        return response($req, 201);

    }


    /**
     * Display the specified resource.
     * @param Request $request
     * @return Response
     */
    public function show(Request $request): Response
    {
        $request->requestable;
        return response($request, 200);
    }

    /*
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
