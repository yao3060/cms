<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $commentable_type = $request->type == 'post' ? 'post' : 'answer';

        $comments = Comment::where([
            ['commentable_id', $request->post_id],
            ['commentable_type', $commentable_type]
        ])->orderBy('id', 'desc')->get();

        foreach($comments as $key=>$comment) {

            $author = User::find($comment->user_id);

            $comments[$key]->author_name = $author->name;
            $comments[$key]->author_avatar = '';
            $comments[$key]->published_at = Carbon::parse($comment->created_at)->diffForHumans();


        }

        return $comments;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'comment' => 'required|min:3|max:255',
            'postID' => 'required',
            'type' => 'required'
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::guard('api')->user()->id;
        $comment->body = $request->comment;
        $comment->commentable_type = $request->type;
        $comment->commentable_id = $request->postID;

        $comment->save();

        $response = [
            'author_name' => Auth::guard('api')->user()->name,
            'author_avatar' => '',
            'published_at' => Carbon::now()->diffForHumans(),
            'body' => $comment->body
        ];

        return $response;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
