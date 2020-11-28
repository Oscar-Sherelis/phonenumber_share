<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class phonenumber_share extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'user_id', 'number_id'
    ];
}