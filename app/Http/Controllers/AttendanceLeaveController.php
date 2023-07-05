<?php

namespace App\Http\Controllers;

use App\Enums\AttendanceLeaveType;
use App\Http\Requests\StoreAttendanceLeaveRequest;
use App\Models\AttendanceLeave;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceLeaveController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttendanceLeaveRequest $request)
    {
        $employee_id = isset($request->employee_id) ? $request->employee_id : \Auth::user()->id;
        $lastInDay = AttendanceLeave::whereDate('date', '=', Carbon::now()->subDay())->first();
        $attendanceLeave = AttendanceLeave::create();
        if (!isset($request->type)) {
            if ($lastInDay == null) {
                // First enter in day
                $attendanceLeave->type = AttendanceLeaveType::Attendance;
            } else {
                if ($lastInDay->type = AttendanceLeaveType::Leave)
                    $attendanceLeave->type = AttendanceLeaveType::Attendance;
                else
                    $attendanceLeave->type = AttendanceLeaveType::Leave;
            }
        }
        $attendanceLeave->date = $request->date;
        $attendanceLeave->employee_id = $employee_id;

    }

    /**
     * Display the specified resource.
     */
    public function show(AttendanceLeave $attendanceLeave)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AttendanceLeave $attendanceLeave)
    {
        //
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
