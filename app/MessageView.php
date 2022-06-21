<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageView extends Model
{
    protected $guarded=[];
    protected $table = "messages";
    protected $primaryKey = 'message_id';
}
