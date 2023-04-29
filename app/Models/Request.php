<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Laravel\Sanctum\HasApiTokens;

class Request extends Model
{
    use HasApiTokens;
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'requestable_id',
        'requestable_type',
    ];
    public function requestable():MorphTo{
        return $this->morphTo();
    }

}
