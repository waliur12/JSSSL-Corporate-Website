<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoardMember extends Model
{
    protected $guarded=[];
    protected $table = "board_members";
    protected $primaryKey = 'board_member_id';
}
