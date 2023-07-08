<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkPlace extends Model
{
    use HasFactory;
    protected $fillable = [
        'lat',
        'lng',
        'address',
        'name',
        'radius'
    ];
}
