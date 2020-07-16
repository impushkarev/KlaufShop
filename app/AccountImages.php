<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountImages extends Model
{
    protected $fillable = [
        'account_id', 'image'
    ];
}
