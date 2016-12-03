<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'news_tag');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
