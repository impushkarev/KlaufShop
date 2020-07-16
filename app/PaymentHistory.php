<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    public static function getTableName() {
        return with(new static)->getTableName();
    }
    
    public function getUser() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    protected $fillable = [
        'user_id', 'amount'
    ];
}
