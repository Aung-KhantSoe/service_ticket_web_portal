<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    public function attachment()
    {
        return $this->hasOne('App\Attachment');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function developer()
    {
        return $this->belongsTo('App\User','dev_id');
    }
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
    public function faq()
    {
        return $this->belongsTo('App\Faq');
    }
}
