<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'requestable_id',
        'requestable_type',
        'description',
        'status',
        'feedback'
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function requestable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getType(): string
    {
        return match ($this->requestable_type) {
            LeaveRequest::class => 'مرخصی',
            default => '',
        };

    }

}
