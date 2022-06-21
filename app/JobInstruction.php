<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobInstruction extends Model
{
    protected $fillable = [
        'job_id',
        'instruction_id',
    ];
}
