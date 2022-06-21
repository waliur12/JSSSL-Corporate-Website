<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    protected $guarded=[];
    protected $table = "social_medias";
    protected $primaryKey = 'social_media_id';
}
