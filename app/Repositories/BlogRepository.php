<?php
/**
 * Created by PhpStorm.
 * User: Yao
 * Date: 2018/11/23
 * Time: 19:34
 */

namespace App\Repositories;

use App\Post;
use Carbon\Carbon;

class BlogRepository
{
    /**
     * @param $id
     * @return mixed
     */
    public function byID($id){

        $post = Post::findOrFail($id)->with('user')->with('user')->first();

        $featuredImageObject = $post->meta('featured_image')->first();
        if ( $featuredImageObject ){
            $post->featured_image = $featuredImageObject->meta_value;
        } else {
            $post->featured_image = '';
        }

        $post->published_at = Carbon::parse($post->published_at)->diffForHumans();

        $post->author_name = $post->user->name;

        return $post;

    }

}
