<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
    public function price()
    {
        return $this->hasOne('App\Price');
    }
}
