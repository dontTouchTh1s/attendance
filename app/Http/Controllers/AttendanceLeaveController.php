<?php

namespace App\Http\Controllers;

use App\Enums\AttendanceLeaveType;
use App\Http\Requests\StoreAttendanceLeaveRequest;
use App\Models\AttendanceLeave;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceLeaveController extends Controller
{
    public function index(Request $request)
    {
        return \response(AttendanceLeave::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttendanceLeaveRequest $request)
    {
        $date = new Carbon($request->date);
        $employee_id = isset($request->employee_id) ? $request->employee_id : \Auth::user()->id;
        $lastInDay = AttendanceLeave::whereDate('date', '=', $date)->first();

        if (!isset($request->type)) {
            if ($lastInDay == null) {
                // First enter in day
                $type = AttendanceLeaveType::Attendance;
            } else {
                if ($lastInDay->type = AttendanceLeaveType::Leave)
                    $type = AttendanceLeaveType::Attendance;
                else
                    $type = AttendanceLeaveType::Leave;
            }
        } else
            $type = $request->type;

        AttendanceLeave::create([
            'employee_id' => $employee_id,
            'date' => $request->date,
            'type' => $type
        ]);
    }


    /**
     * Show attendance leaves for current user
     */
    public function user()
    {
        return AttendanceLeave::all()->where('employee_id', '=', \Auth::user()->employee()->id);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AttendanceLeave $attendanceLeave)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AttendanceLeave $attendanceLeave)
    {
        //
    }
}
