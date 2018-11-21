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
            <span class="is-pulled-right">
                <a href="{{ route('terms.index') }}" class="button">Terms</a>
                <a href="#" @click="showSlug" class="button">Show Slug</a>
                <a href="{{ route('posts.create') }}" class="button">Add New</a>
            </span>
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
                    <th>Categories</th>
                    <th>Tags</th>
                    <th>Publish At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                <tr id="post_{{$post->id}}">
                    <td>{{ $post->id }}</td>
                    <td>
                        {{ $post->title }}<br>
                        <small class="is-light is-small" v-show="show_slug">( {{ $post->slug }} )</small>
                    </td>
                    <td>{{ $post->author_id }}</td>
                    <td>
                        @foreach($post->categories as $category)
                            <a class="button is-text is-small" href="{{ route('terms.show', $category->id) }}">{{ $category->name }}</a>
                        @endforeach
                    </td>
                    <td>
                        @foreach($post->tags as $tag)
                            <a class="button is-text is-small" href="{{ route('terms.show', $tag->id) }}">{{ $tag->name }}</a>
                        @endforeach
                    </td>
                    <td>{{ $post->published_at }}</td>
                    <td>
                        <a href="{{ route('posts.edit', $post->id) }}" class="button is-small">Edit</a>
                    </td>
                </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

@endsection

@section('scripts')
<script>
    var app = new Vue({
        el: "#app",
        data: {
            show_slug: false
        },
        methods:{
            showSlug: function () {
                if(this.show_slug){
                    this.show_slug = false
                } else {
                    this.show_slug = true;
                }
            }
        }

    });
</script>
@endsection
