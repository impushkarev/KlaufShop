<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CasePrize extends Model
{
    public function getPrizeList() {
        return $this->hasMany('App\CasePrizeList', 'case_prize_id', 'id');
    }

    protected $fillable = [
        'case_id', 'name', 'chance', 'type',
    ];
}
