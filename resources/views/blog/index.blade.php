<?php
/**
 * Created by PhpStorm.
 * User: Yao
 * Date: 2018/11/22
 * Time: 22:31
 */
?>

@extends('layouts.app')

@section('content')

    <div class="columns">
        <div class="column is-three-quarters">
            <nav class="breadcrumb" aria-label="breadcrumbs">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li class="is-active"><a href="#" aria-current="page">Blog</a></li>
                </ul>
            </nav>

            <div class="posts m-b-20">

                @foreach($posts as $post)

                <article class="media" id="post-{{ $post->id }}">
                    <figure class="media-left">
                        <p class="image is-64x64">
                            <img src="https://bulma.io/images/placeholders/128x128.png">
                        </p>
                    </figure>
                    <div class="media-content">
                        <div class="content">
                            <p>
                                <strong><a href="{{ route('blog.show', $post->id) }}">{{ $post->title }}</a></strong>
                                <small>{{ $post->author_name }}</small>
                                <small>{{ $post->published_at }}</small>
                                <small>Answers: {{ is_null($post->answer_count) ? '0' : $post->answer_count->meta_value }}</small>


                                <br>
                                {{ $post->excerpt }}
                            </p>
                        </div>
                        <nav class="level is-mobile">
                            <div class="level-left">
                                <a class="level-item">
                                    <span class="icon is-small"><i class="fas fa-reply"></i></span>
                                </a>
                                <a class="level-item">
                                    <span class="icon is-small"><i class="fas fa-retweet"></i></span>
                                </a>
                                <a class="level-item">
                                    <span class="icon is-small"><i class="fas fa-heart"></i></span>
                                </a>
                            </div>
                        </nav>
                    </div>
                </article>

                @endforeach
            </div>

            <hr>
            
            {{ $posts->links() }}

        </div>
        <div class="column">

            @for ($i = 1; $i <= 10; $i++)
            <div class="card m-b-20">
                <header class="card-header">
                    <p class="card-header-title">Widget {{ $i }}</p>
                </header>
                <div class="card-content">
                    <div class="content">
                        ...
                    </div>
                </div>
            </div>

            @endfor
        </div>
    </div>

@endsection
