<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Model
{
    use HasFactory;

    public function groupPolicy(): BelongsTo
    {
        return $this->belongsTo(GroupPolicy::class);
    }

    public function manager(): HasOne
    {
        return $this->hasOne(Employee::class);
    }

    public function requests(): HasMany
    {
        return $this->hasMany(Request::class);
    }
}
