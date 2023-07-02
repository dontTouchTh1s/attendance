<?php

namespace App\Http\Controllers;

use App\Enums\RequestStatus;
use App\Http\Requests\StoreRequestRequest;
use App\Http\Resources\RequestResource;
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
        return RequestResource::collection(Request::all());
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreRequestRequest $request
     * @return Response
     */
    public function store(StoreRequestRequest $request): Response
    {
        $requestable = null;
        switch ($request->type) {
            case 'leave': //Creating leave request
                $requestable = LeaveRequest::create([
                    'from_date' => $request->from_date,
                    'to_date' => $request->to_date,
                    'from_hour' => $request->from_hour,
                    'to_hour' => $request->to_hour,
                    'type' => $request->leave_type,
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
        $employee_id = isset($request->employee_id) ? $request->employee_id : \Auth::user()->id;
        $req = Request::create([
            'employee_id' => $employee_id,
            'requestable_id' => $requestable->id,
            'requestable_type' => $requestable::class,
            'status' => RequestStatus::Pending,
            'description' => $request->description,
        ]);
        $req->requestable;
        return response($req, 201);

    }


    /**
     * Display the specified resource.
     * @param Request $request
     * @return RequestResource
     */
    public function show(Request $request)
    {
        return new RequestResource($request);

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
    }
}
