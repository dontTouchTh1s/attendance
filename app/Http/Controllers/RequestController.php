<?php

namespace App\Http\Controllers;

use App\Enums\RequestStatus;
use App\Http\Requests\StoreRequestRequest;
use App\Http\Requests\UpdateRequestRequest;
use App\Http\Resources\RequestResource;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(\Illuminate\Http\Request $request)
    {
        $status = $request->validate(['status' => 'string'])['status'];
        if ($status === '')
            return RequestResource::collection(Request::all());
        else if ($status === 'pending') {
            return RequestResource::collection(Request::all()->where('status', '=', 'pending'));
        } else return new Response('unknown parameter value', 400);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreRequestRequest $request
     * @return Response
     */
    public function store(StoreRequestRequest $request)
    {
        $requestable = null;
        $employee_id = isset($request->employee_id) ? $request->employee_id : \Auth::user()->id;
        switch ($request->type) {
            case 'leave': //Creating leave request
                if (!isset($request->from_hour)) {
                    $policy = Employee::find($employee_id)->groupPolicy;
                    $from_hour = $policy->work_start_hour;
                    $to_hour = $policy->work_end_hour;
                } else {
                    $from_hour = $request->from_hour;
                    $to_hour = $request->to_hour;
                }
                $requestable = LeaveRequest::create([
                    'from_date' => $request->from_date,
                    'to_date' => $request->to_date,
                    'from_hour' => $from_hour,
                    'to_hour' => $to_hour,
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

    public function update(UpdateRequestRequest $request, Request $requestModel = null)
    {
        $values = $request->rows;
        if ($requestModel != null) {
            $requestModel->fill($values)->save();
            return response($requestModel);
        } else {
            foreach ($request->ids as $id) {
                try {
                    $model = Request::findOrFail($id);
                    $model->fill($values)->save();
                } catch (ModelNotFoundException $e) {
                    return \response('no request with id finds', 404);
                }

            }
            return \response('success', 200);
        }
        return \response('No parameter for updating requests', 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
    }
}
