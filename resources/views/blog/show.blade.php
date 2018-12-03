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
                    <li><a href="{{ route('blog.index') }}">Blog</a></li>
                    <li class="is-active"><a href="#" aria-current="page">{{ $post->title }}</a></li>
                </ul>
            </nav>


            <article id="post-{{ $post->id }}">

                <header class="m-b-20">
                    <h1 class="title">{{ $post->title }}</h1>
                    <p>
                        <small>Author: <a href="#{{ $post->user->id }}"></a>{{ $post->author_name }}</small>
                        <small>Published: {{ $post->published_at }}</small>
                        <small>View: {{ $view }}</small>
                        <comments-widget postid="{{ $post->id }}" type="post"></comments-widget>
                    </p>
                </header>


                <div class="content">

                    <div class="notification">{{ $post->excerpt }}</div>

                    {!! $post->content !!}
                </div>

                <nav class="level is-mobile">
                    <div class="level-left">

                        @foreach($post->categories as $category)
                            <a class="level-item">
                                <span class="button is-text is-small" href="/category/{{  $category->id }}">{{ $category->name }}</span>
                            </a>
                        @endforeach

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


            </article>

            <hr>

            <div class="answers m-b-20">




                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">Answers</p>
                    </header>
                    <div class="card-content">
                        <div class="content">

                            @foreach($post->answers as $answer)

                                <article class="answer media">
                                    <figure class="media-left">
                                        <p class="image is-64x64">
                                            <img src="https://bulma.io/images/placeholders/128x128.png">
                                        </p>
                                    </figure>
                                    <div class="media-content">
                                        <div class="content">
                                            <strong class="sudtitle">{{ $answer->user->name }}</strong>
                                            <small>{{ $answer->created_at->diffForHumans() }}</small>
                                            <br>
                                            {!! \Xmeltrut\Autop\Autop::format($answer->body); !!}
                                        </div>
                                    </div>
                                </article>

                            @endforeach

                                <hr>

                                @guest

                                    <a href="{{ route('login') }}" class="button is-success">Login</a>

                                @else

                                    <form action="{{ route('blog.answer.store', $post->id) }}" method="POST">
                                        @csrf
                                        <b-field label="">
                                            <b-input type="textarea" name="answer"></b-input>
                                        </b-field>
                                        <div class="field">
                                            <button class="button">Submit</button>
                                        </div>
                                    </form>

                                @endguest
                        </div>
                    </div>
                </div>
            </div>

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


@section('scripts')
<script>

        @guest
            var api_token = '';
        @else
            var api_token = '{{ Auth::user()->api_token }}';
        @endguest

    var app = new Vue({
        el: '#app',
        data: {
            api_token: api_token
        }
    });

</script>
@endsection
