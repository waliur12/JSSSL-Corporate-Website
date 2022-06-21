<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded=[];
    protected $table = "events";
    protected $primaryKey = 'event_id';
    protected $dates = ['event_dated_at'];
}
