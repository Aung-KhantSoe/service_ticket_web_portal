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
    public function faqs()
    {
        return $this->hasMany('App\Faq');
    }
    public function price()
    {
        return $this->hasOne('App\Price');
    }
}
