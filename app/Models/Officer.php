<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'area',
        'gender',
        'schedule_days'
    ];
}
