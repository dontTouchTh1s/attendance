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
    public function requestable():MorphTo{
        return $this->morphTo();
    }

}
