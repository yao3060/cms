<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Repositories\BlogRepository;

class BlogController extends Controller
{
    protected $blogRepository;

    public function __construct( BlogRepository $blogRepository )
    {
        $this->blogRepository = $blogRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::orderBy('id', 'desc')->paginate(2);

        foreach ($posts as $post) {
            $post->author_name = User::findOrFail($post->author_id)->name;
            $post->published_at = Carbon::parse($post->published_at)->diffForHumans();
            $post->answer_count = $post->meta('answer_count')->first();
        }

        return view('blog.index')
            ->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        //$post = $this->blogRepository->byID($id);

        $post = Post::findOrFail($id)->with(['user', 'answers'])->first();

        $featuredImageObject = $post->meta('featured_image')->first();
        if ( $featuredImageObject ){
            $post->featured_image = $featuredImageObject->meta_value;
        } else {
            $post->featured_image = '';
        }

        $post->published_at = Carbon::parse($post->published_at)->diffForHumans();

        $post->author_name = $post->user->name;

        $view_count = $post->meta('view_count')->first();
        //dd($view_count);
        if($view_count){

            $view_count->update(['meta_value' => $view_count->meta_value+1]);
            $post_view_count = $view_count->meta_value;

        }else{
            $post->metas()->insert([
                'post_id' => $post->id,
                'meta_key' => 'view_count',
                'meta_value' => 1
            ]);
            $post_view_count = 1;
        }

        return view('blog.show')
            ->with('post', $post)
            ->with('view', $post_view_count);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
