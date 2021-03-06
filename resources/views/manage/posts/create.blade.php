<?php
/**
 * Created by PhpStorm.
 * User: Yao
 * Date: 2018/11/20
 * Time: 8:38
 */
?>

@extends('layouts.manage')

@section('content')

    <h1 class="title">Add new post</h1>
    <hr>

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="columns">
            <div class="column is-three-quarters">

                <b-field>
                    <b-input name="title" placeholder="Post Title" v-model="title"></b-input>
                </b-field>

                <slug-widget url="{{ url('/') }}"
                             subdirectory="blog"
                             :title="title"
                             @slug-changed="updateSlug"></slug-widget>
                <input type="hidden" v-model="slug" name="slug" />

                <hr class="m-t-20">

                <b-field label="Content">
                    <b-input type="textarea" name="post_content" placeholder="Content"></b-input>
                </b-field>


        </div>
            <div class="column">

                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">Publish</p>
                    </header>

                    <div class="card-content">
                        <div class="content">
                        <article class="media">
                            <div class="media-left is-48x48">
                                <figure class="image is-rounded is-48x48">
                                    <img src="https://bulma.io/images/placeholders/128x128.png" alt="Image">
                                </figure>
                            </div>
                            <div class="media-content">
                                <div class="content">
                                    <p>
                                        <strong>{{ $user->name }}</strong>
                                        <small>{{ $user->email }}</small>
                                        <input type="hidden" name="author_id" value="{{ $user->id }}">
                                    </p>
                                </div>
                            </div>
                        </article>
                        </div>
                    </div>

                    <footer class="card-footer">
                        <a href="#" class="card-footer-item">Draft</a>
                        <a href="#" class="card-footer-item">
                            <button class="button is-text">Publish</button>
                        </a>
                        <a href="#" class="card-footer-item">Delete</a>
                    </footer>

                </div>


                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">Category</p>
                    </header>
                    <div class="card-content">
                        <div class="content">

                            @foreach($categories as $category)

                                <div class="field">
                                    <b-checkbox native-value="{{ $category->id }}" v-model="categories">
                                        {{$category->name}}
                                    </b-checkbox>
                                </div>

                            @endforeach

                                <input type="hidden" name="categories" class="input" :value="categories">

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>

@endsection

@section('scripts')
<script>
    var app = new Vue({
        el: "#app",
        data: {
            title: '',
            slug: '',
            categories:[],
            api_token: '{{Auth::user()->api_token}}'
        },
        methods:{
            updateSlug: function (val) {
                this.slug = val
            }
        }
    });
</script>
@endsection
