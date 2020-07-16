<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CasePrizeList extends Model
{
    public static function getTableName() {
        return with(new static)->getTableName();
    }

    public function getCase() {
        return $this->hasOneThrough('App\Cases', 'App\CasePrize', 'id', 'id', 'case_prize_id', 'case_id');
    }

    public function getPrize() {
        return $this->hasOne('App\CasePrize', 'id', 'case_prize_id');
    }

    public function getUser() {
        return $this->hasOne('App\User', 'id', 'getBy');
    }

    protected $fillable = [
        'case_prize_id', 'data',
    ];
}
