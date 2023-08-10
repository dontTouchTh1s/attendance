<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'group_policy_id',
        'manager_id',
        'user_id'
    ];

    public function groupPolicy(): BelongsTo
    {
        return $this->belongsTo(GroupPolicy::class);
    }

    public function manager(): BelongsTo
    {
        return $this->BelongsTo(Employee::class, 'manager_id');
    }

    public function employees(): HasMany
    {
        return $this->HasMany(Employee::class, 'manager_id');
    }

    public function requests(): HasMany
    {
        return $this->hasMany(Request::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function attendanceLeaves(): HasMany
    {
        return $this->hasMany(AttendanceLeave::class);
    }

    public function totalLeaveMonth($month): int
    {
        $requests = $this->requests->where('requestable_type', LeaveRequest::class);
        $totalLeave = 0;

        // Check for remain leave time in month
        foreach ($requests as $item) {
            $from_date = new Carbon($item->requestable->from_date);
            $to_date = new Carbon($item->requestable->to_date);
            if ($from_date->month == $month) {
                $iFrom_hour = new Carbon($item->requestable->from_hour);
                $iTo_hour = new Carbon($item->requestable->to_hour);
                $hourWorkTime = $iTo_hour->diffInHours($iFrom_hour);
                $diff = $from_date->diffInDays($to_date) * $hourWorkTime * 60;
                $totalLeave += $diff;

            }
        }
        return $totalLeave;
    }

    public function totalLeaveYear($year): int
    {
        $requests = $this->requests->where('requestable_type', LeaveRequest::class);
        $totalLeave = 0;
        // Check for remain leave time in year
        foreach ($requests as $item) {
            $from_date = new Carbon($item->requestable->from_date);
            $to_date = new Carbon($item->requestable->to_date);
            if ($from_date->year == $year) {
                $iFrom_hour = new Carbon($item->requestable->from_hour);
                $iTo_hour = new Carbon($item->requestable->to_hour);
                $hourWorkTime = $iTo_hour->diffInHours($iFrom_hour);
                $diff = $from_date->diffInDays($to_date) * $hourWorkTime * 60;
                $totalLeave += $diff;
            }

        }
        return $totalLeave;
    }
}
