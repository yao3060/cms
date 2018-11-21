<?php

namespace App\Http\Controllers;

use App\Post;
use App\Term;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PostCollection;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:superadministrator|administrator|editor');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::orderBy('id')->get();
        //return \App\Http\Resources\Post::collection($posts);
        return view('manage.posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = Auth::user();

        $categories = Term::where('taxonomy', '=', 'category')->orderBy('slug')->get();

        return view('manage.posts.create')
            ->with('categories', $categories)
            ->with('user', $user);
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
        $this->validate($request, [
            'title' => 'required|max:255|min:3',
            'slug' => 'required|max:100|unique:posts',
            'content' => 'sometimes'
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->slug = $request->slug;
        //$post->excerpt = '';
        $post->content = $request->post_content;
        $post->author_id = $request->author_id;
        $post->published_at = date('Y-m-d H:i:s');
        $terms = $request->terms;

        if ($post->save()){

            if(!empty($terms)){
                $terms = explode(',', $terms);
                $post->terms()->sync($terms, true);
            }

        }
        return redirect()->route('posts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = Auth::user();
        $post = Post::findOrFail($id);
        $categories = Term::where('taxonomy', '=', 'category')->orderBy('slug')->get();
        $tags = Term::where('taxonomy', '=', 'tag')->orderBy('slug')->get();

        return view('manage.posts.edit')
            ->with('categories', $categories)
            ->with('tags', $tags)
            ->with('post', $post)
            ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        dd($request);
        $post = Post::findOrFail($id);

        $this->validate($request, [
            'title' => 'required|max:255|min:3',
            'slug' => 'required|max:100|unique:posts,id,'.$id,
            'content' => 'sometimes'
        ]);

        $post->title = $request->title;
        $post->slug = $request->slug;
        //$post->excerpt = '';
        $post->content = $request->post_content;
        $post->author_id = $request->author_id;
        $terms = $request->terms;

        if ($post->save()){

            if(!empty($terms)){
                $terms = explode(',', $terms);
                $post->terms()->sync($terms, true);
            }

        }

        Session::flash('success', "Post was updated successfully.");

        return redirect()->route('posts.edit', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

    }

    public function apiCheckSlug(Request $request){

        return json_encode(!Post::where('slug', '=', $request->slug)->exists());
    }
}
