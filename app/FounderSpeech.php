<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FounderSpeech extends Model
{
    protected $guarded=[];
    protected $table = "founder_speeches";
    protected $primaryKey = 'founder_speech_id';
}
