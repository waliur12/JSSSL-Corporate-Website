<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingExperience extends Model
{
    protected $guarded=[];
    protected $table = "working_experiences";
    protected $primaryKey = 'working_experience_id ';
}
