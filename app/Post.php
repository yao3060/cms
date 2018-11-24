<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    //
    protected $fillable = ['title', 'slug', 'excerpt', 'content', 'author_id'];

    public function user()
    {
        return $this->belongsTo('App\User', 'author_id', 'id');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function meta($meta_key = ''){

        if( $meta_key == '' ) return $this->metas();

        return $this->hasMany('App\Postmeta')->where('meta_key', $meta_key);
    }

    public function metas()
    {
        return $this->hasMany('App\Postmeta');
    }

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
