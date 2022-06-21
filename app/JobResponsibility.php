<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobResponsibility extends Model
{
    protected $fillable = [
        'job_id',
        'responsibility_id',
    ];
}
