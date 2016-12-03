<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function news()
    {
        return $this->hasMany('App\Models\News');
    }

    public function category()
    {
        return $this->hasOne('App\Models\Category');
    }
}
