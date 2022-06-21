<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubService extends Model
{
    protected $guarded=[];
    protected $table = "sub_services";
    protected $primaryKey = 'sub_service_id';

    public function getService(){
        return $this->belongsTo(Service::class,'service_id');
    }
}
