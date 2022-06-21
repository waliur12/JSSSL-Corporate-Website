<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobRequirement extends Model
{
    protected $fillable = [
        'job_id',
        'requirement_id',
    ];
}
