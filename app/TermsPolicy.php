<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TermsPolicy extends Model
{
    protected $guarded=[];
    protected $table = "terms_policies";
    protected $primaryKey = 'terms_policy_id';
}
