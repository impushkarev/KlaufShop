<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{

    public function images() {
        return $this->hasMany('App\AccountImages');
    }

    protected $fillable = [
        'name', 'game', 'description', 'mres', 'ares', 'dres', 
        'rang', 'desc_rang', 'lvl',
        'login', 'password', 'isLinked', 'price',
    ];
}
