<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateLeaveRequestRequest;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class LeaveRequestController extends Controller
{
    public function index(Request $request)
    {
        $inputs = $request->validate([
            'employee_id' => 'exists:App\Models\Employee,id',
            'count' => 'integer',
            'order_by' => '',
            'order_option' => 'in:ASC,DESC|required_with:order_by'
        ]);
        if (isset($inputs['employee_id'])) {
            $employee = $inputs['employee_id'];
            $data = DB::table('employees')
                ->select(DB::raw('requests.id, description, status, feedback, requests.created_at, type, from_date, to_date, from_hour, to_hour'))
                ->join('requests', 'employees.id', '=', 'requests.employee_id')
                ->join('leave_requests', 'requests.requestable_id', '=', 'leave_requests.id')
                ->where('employees.id', $employee)
                ->get();
        } else {
            $data = DB::table('employees')
                ->select(DB::raw('MONTHNAME(from_date) as month, SUM(DATEDIFF(leave_requests.to_date, leave_requests.from_date)) as time'))
                ->join('users', 'employees.user_id', '=', 'users.id')
                ->join('requests', 'employees.id', '=', 'requests.employee_id')
                ->join('leave_requests', 'requests.requestable_id', '=', 'leave_requests.id')
                ->where('users.id', \Auth::user()->id)
                ->groupBy('month')->get();
        }
        if (isset($inputs['count'])) {
            $data = $data->take($inputs['count']);
        }
        if (isset($inputs['order_by'])) {
            $data = $data->sortBy($inputs['order_by'], SORT_NATURAL, ($inputs['order_option'] === 'DESC'))->values();
        }
        return \response($data);


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
