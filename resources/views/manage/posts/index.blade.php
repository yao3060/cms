<?php
/**
 * Created by PhpStorm.
 * User: Yao
 * Date: 2018/11/20
 * Time: 6:36
 */
?>
@extends('layouts.manage')

@section('content')

    <div class="columns">
        <div class="column">
            <h1 class="title">Posts</h1>
        </div>
        <div class="column">
            <spam class="is-pulled-right">
                <a href="{{ route('posts.create') }}" class="button">Add New</a>
            </spam>
        </div>
    </div>

    <hr>

    <div class="columns">
        <div class="column">

            <table class="table is-fullwidth">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Publish At</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>
                        {{ $post->title }}
                        <em>( {{ $post->slug }} )</em>
                    </td>
                    <td>{{ $post->author_id }}</td>
                    <td>{{ $post->published_at }}</td>
                    <td></td>
                    <td></td>
                </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

@endsection
