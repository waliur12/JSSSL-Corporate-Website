<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EthicalCode extends Model
{
    protected $guarded=[];
    protected $table = "ethical_codes";
    protected $primaryKey = 'ethical_code_id';
}
