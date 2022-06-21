<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded=[];
    protected $table = "clients";
    protected $primaryKey = 'client_id';

    public function getClientCat(){
        return $this->belongsTo(ClientCategories::class,'client_category_id');
    }
}
