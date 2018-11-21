<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    //

    public function categories()
    {
        $model = $this->belongsToMany(
            'App\Term',
            'post_term',
            'post_id',
            'term_id'
        )->where('taxonomy', '=', 'category');

        return $model;
    }

    public function tags()
    {
        return $this->belongsToMany(
            'App\Term',
            'post_term',
            'post_id',
            'term_id'
        )->where('taxonomy', '=', 'tag');
    }

    public function terms()
    {
        return $this->belongsToMany(
            'App\Term',
            'post_term',
            'post_id',
            'term_id');
    }
}
