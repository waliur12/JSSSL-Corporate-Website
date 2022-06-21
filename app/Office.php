<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $guarded=[];
    protected $table = "offices";
    protected $primaryKey = 'office_id';
}
