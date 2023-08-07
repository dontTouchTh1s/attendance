<?php

namespace App\Http\Controllers;

use App\Enums\LeaveRequestsType;
use App\Enums\RequestStatus;
use App\Http\Requests\StoreRequestRequest;
use App\Http\Requests\UpdateRequestRequest;
use App\Http\Resources\RequestResource;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\Request;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(\Illuminate\Http\Request $request)
    {
        $roll = \Auth::user()->roll;
        $data = $request->validate(['status' => 'string']);
        if (isset($data['status'])) {
            $status = $data['status'];
            if ($status === 'pending') {
                if ($roll == 'manager') {
                    $manager = \Auth::user()->employee;
                    $requests = [];
                    $managerEmployees = $manager->employees;
                    foreach ($managerEmployees as $managerEmployee) {
                        foreach ($managerEmployee->requests as $employeeRequest) {
                            if ($employeeRequest->status == 'pending')
                                $requests[] = $employeeRequest;
                        }
                    }
                    return RequestResource::collection($requests);
                }

                return RequestResource::collection(Request::all()->where('status', '=', 'pending'));
            } else return new Response('unknown parameter value', 400);
        } else {
            if ($roll == 'manager') {
                $manager = \Auth::user()->employee;
                $requests = [];
                $managerEmployees = $manager->employees;
                foreach ($managerEmployees as $managerEmployee) {
                    foreach ($managerEmployee->requests as $employeeRequest) {
                        $requests[] = $employeeRequest;
                    }
                }
                return RequestResource::collection($requests);
            } else
                return RequestResource::collection(Request::all());
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreRequestRequest $request
     * @return Response
     */
    public function store(StoreRequestRequest $request)
    {

        $requestable = null;
        $employee_id = isset($request->employee_id) ? $request->employee_id : \Auth::user()->employee->id;
        switch ($request->type) {
            case 'leave': //Creating leave request
                if ($request->leave_type == LeaveRequestsType::Paid->value) {
                    // If leave request type is paid, check for remain leave time in month and year


                    $rFrom_date = new Carbon($request->from_date);
                    $rTo_date = new Carbon($request->to_date);
                    $employee = Employee::find($employee_id);

                    if (!isset($request->from_hour)) {
                        $policy = $employee->groupPolicy;
                        $from_hour = $policy->work_start_hour;
                        $to_hour = $policy->work_end_hour;
                        $hourWorkTime = $policy->hourWorkInDay();
                    } else {
                        $from_hour = $request->from_hour;
                        $to_hour = $request->to_hour;
                        $start = new Carbon($from_hour);
                        $end = new Carbon($to_hour);
                        $hourWorkTime = $end->diffInHours($start);

                    }


                    $dayDiff = $rTo_date->diffInDays($rFrom_date);
                    $requestAmount = $dayDiff * $hourWorkTime * 60;


                    $requests = $employee->requests;
                    $totalLeave = 0;

                    // Check for remain leave time in month
                    foreach ($requests as $item) {
                        if ($item->requestable_type == LeaveRequest::class) {
                            $from_date = new Carbon($item->requestable->from_date);
                            $to_date = new Carbon($item->requestable->to_date);
                            if ($from_date->month == $rFrom_date->month) {
                                $iFrom_hour = new Carbon($item->requestable->from_hour);
                                $iTo_hour = new Carbon($item->requestable->to_hour);
                                $hourWorkTime = $iTo_hour->diffInHours($iFrom_hour);
                                $diff = $from_date->diffInDays($to_date) * $hourWorkTime * 60;
                                $totalLeave += $diff;
                            }
                        }
                    }
                    if ($totalLeave + $requestAmount > $employee->groupPolicy->max_leave_month)
                        return \response('Cant request this amount of leave in this month', 422);

                    // Check for remain leave time in year
                    foreach ($requests as $item) {
                        if ($item->requestable_type == 'leave') {
                            $from_date = new Carbon($item->requestable->from_date);
                            $to_date = new Carbon($item->requestable->to_date);
                            if ($from_date->year == $rFrom_date->year) {
                                $iFrom_hour = new Carbon($item->requestable->from_hour);
                                $iTo_hour = new Carbon($item->requestable->to_hour);
                                $hourWorkTime = $iTo_hour->diffInHours($iFrom_hour);
                                $diff = $from_date->diffInDays($to_date) * $hourWorkTime * 60;
                                $totalLeave += $diff;
                            }
                        }
                    }
                    if ($diff > $employee->groupPolicy->max_leave_year)
                        return \response('Cant request this amount of leave in this year', 422);
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
    }
}
