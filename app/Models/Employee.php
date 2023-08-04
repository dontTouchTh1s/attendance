<?php

namespace App\Models;

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
}
