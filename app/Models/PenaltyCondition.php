<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenaltyCondition extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'penalty',
        'duration',
        'group_policy_id'
    ];

    public function groupPolicy(): BelongsTo
    {
        return $this->belongsTo(GroupPolicy::class);
    }
}
