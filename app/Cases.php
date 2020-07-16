<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
    public function prizes() {
        return $this->hasMany('App\CasePrize', 'case_id', 'id');
    }

    protected $fillable = [
        'image', 'name', 'type', 'price'
    ];
}
