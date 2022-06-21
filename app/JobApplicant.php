<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobApplicant extends Model
{
    protected $fillable = [
        'job_id',
        'applicant_id',
    ];
}
