<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded=[];
    protected $table = "services";
    protected $primaryKey = 'service_id';

    public function sub_services(){
        return $this->hasMany(SubService::class,'service_id');
    }
}
