<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postmeta extends Model
{
    //
    public $timestamps = false;
    protected $table = 'postmeta';
    protected $fillable = ['post_id', 'meta_key', 'meta_value'];

    public function post(){
        return $this->belongsTo('App\Post');
    }
}
