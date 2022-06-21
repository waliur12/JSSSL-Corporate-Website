<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
    ];
}
