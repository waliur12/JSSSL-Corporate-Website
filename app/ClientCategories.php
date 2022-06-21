<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientCategories extends Model
{
    protected $guarded=[];
    protected $table = "client_categories";
    protected $primaryKey = 'client_category_id';

    
    public function clients(){
        return $this->hasMany(Client::class,'client_category_id')->orderBy('client_precedence','asc');
    }
}
