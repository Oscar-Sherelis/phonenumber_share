<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class phonenumbers extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'user_id', 'phonenumber'
    ];
}