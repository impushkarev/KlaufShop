<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    public function getedItems() {
        return $this->hasMany('App\CasePrizeList', 'getBy', 'id');
    } 

    public function boughtItems() {
        return $this->hasMany('App\Account', 'boughtBy', 'id');
    }

    public function referralUser() {
        return $this->hasOne('App\User', 'referral', 'id');
    }

    protected $fillable = [
        'name', 'avatar', 'referral'
    ];
}
