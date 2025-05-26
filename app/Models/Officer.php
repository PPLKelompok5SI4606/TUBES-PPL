<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    protected $fillable = [
        'name',
        'area',
        'schedule_days',
        'phone',
        'gender',
        'email',
        'address',
    ];
}