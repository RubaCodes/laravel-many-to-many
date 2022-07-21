<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function categories(){
        return $this->hasOne('App\Category');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag');
    }
}
