<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateLeaveRequestRequest;
use App\Models\LeaveRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class LeaveRequestController extends Controller
{
    public function index()
    {
        $data = DB::table('employees')
            ->select(DB::raw('MONTHNAME(from_date) as month, SUM(DATEDIFF(leave_requests.to_date, leave_requests.from_date)) as time'))
            ->join('users', 'employees.user_id', '=', 'users.id')
            ->join('requests', 'employees.id', '=', 'requests.employee_id')
            ->join('leave_requests', 'requests.requestable_id', '=', 'leave_requests.id')
            ->where('users.id', \Auth::user()->id)
            ->groupBy('month')->get();
        return $data;


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
