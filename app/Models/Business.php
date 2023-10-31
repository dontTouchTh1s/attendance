<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',

    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);

    }

    public function workPlaces(): HasMany
    {
        return $this->hasMany(WorkPlace::class);
    }

}
