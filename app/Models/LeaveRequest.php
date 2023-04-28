<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class LeaveRequest extends Model
{
    use HasFactory;

    public function request(): MorphOne{
        return $this->morphOne(Request::class, 'requestable');
    }
}
