<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkPlace extends Model
{
    use HasFactory;

    protected $fillable = [
        'location',
        'address',
        'name',
        'radius'
    ];

    public function groupPolicies(): HasMany
    {
        return $this->hasMany(GroupPolicy::class);
    }
}
