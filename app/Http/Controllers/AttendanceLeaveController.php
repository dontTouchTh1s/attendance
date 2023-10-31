<?php

namespace App\Http\Controllers;

use App\Enums\AttendanceLeaveType;
use App\Enums\PenaltyConditionType;
use App\Enums\PenaltyType;
use App\Http\Requests\StoreAttendanceLeaveRequest;
use App\Models\AttendanceLeave;
use App\Models\Employee;
use App\Models\Penalty;
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
        $lastInDay = AttendanceLeave::whereDate('date', '=', $date)
            ->orderBy('date', 'desc')
            ->first();

        // Get penalty condition
        $delayPenaltyCondition = null;
        $employee = Employee::find($employee_id);
        $groupPolicy = $employee->groupPolicy;
        $penaltyConditions = $groupPolicy->penaltyConditions;
        foreach ($penaltyConditions as $penaltyCondition) {
            if ($penaltyCondition->type == PenaltyConditionType::Delay->value)
                $delayPenaltyCondition = $penaltyCondition;
        }


        if ($lastInDay == null) {
            // First enter in day
            // Check if user group policy have delay penalty condition
            if ($delayPenaltyCondition != null) {
                $workStart = new Carbon($employee->groupPolicy->work_start_hour);
                $delay = $date->diffInMinutes($workStart);
                if ($delay > $delayPenaltyCondition->duration) {
                    // Employee should have penalty
                    $noPaidLeaveTimeRemain = false;
                    $penaltyType = $delayPenaltyCondition->penalty_type;
                    $penaltyTime = $delayPenaltyCondition->penalty;
                    if ($penaltyType == PenaltyType::Paid->value) {

                        // Check if there is remained leave time for employee
                        $remainLeaveMonth = $groupPolicy->max_leave_month - $employee->totalLeaveMonth($date->month);
                        $remainLeaveYear = $groupPolicy->max_leave_year - $employee->totalLeaveYear($date->year);
                        // If remained time is less than penalty time, check if we should penalize him or not
                        if ($penaltyTime > $remainLeaveMonth or $penaltyTime > $remainLeaveYear) {
                            if ($delayPenaltyCondition->penalty_if_no_leave_remains) {
                                $penaltyType = PenaltyType::NoPaid->value;
                            } else {
                                $noPaidLeaveTimeRemain = true;
                            }
                        }
                    }
                    if ($noPaidLeaveTimeRemain !== true) {
                        $penalty = new Penalty();
                        $penalty->fill([
                            'type' => $penaltyType,
                            'duration' => $penaltyTime
                        ]);
                    }

                }
            }
            $type = AttendanceLeaveType::Attendance;
        } else {
            if ($lastInDay->type = AttendanceLeaveType::Leave)
                $type = AttendanceLeaveType::Attendance;
            else {
                $type = AttendanceLeaveType::Leave;
            }
        }

        if (isset($request->type))
            $type = $request->type;

        $al = AttendanceLeave::create([
            'employee_id' => $employee_id,
            'date' => $request->date,
            'type' => $type
        ]);
        if (isset($penalty)) {
            $penalty->attendance_leave_id = $al->id;
            $penalty->save();
        }
    }


    /**
     * Show attendance leaves for current user
     */
    public function user()
    {
        return AttendanceLeave::all()->where('employee_id', '=', \Auth::user()->employee->id);
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
