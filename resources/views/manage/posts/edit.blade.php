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

    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        {{ method_field('PUT') }}

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
                    <b-input type="textarea" name="excerpt" value="{{$post->excerpt}}"></b-input>
                </b-field>

                <div class="control">
                    <!-- 编辑器容器 -->
                    <script id="container" name="post_content" type="text/plain">{!!  $post->content  !!}</script>
                </div>

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

                <div class="card m-t-20">
                    <header class="card-header">
                        <p class="card-header-title">Feature Image</p>
                    </header>
                    <div class="card-content">
                        <div class="content">
                            <image-upload image-url="{{ $post->featured_image }}"></image-upload>
                        </div>
                    </div>
                </div>

                <div class="card m-t-20">
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

                        </div>
                    </div>
                </div>

                <div class="card m-t-20">
                    <header class="card-header">
                        <p class="card-header-title">Tags</p>
                    </header>
                    <div class="card-content">
                        <div class="content">

                            @foreach($tags as $tag)

                                <div class="field">
                                    <b-checkbox native-value="{{ $tag->id }}" v-model="tags">
                                        {{$tag->name}}
                                    </b-checkbox>
                                </div>

                            @endforeach



                        </div>
                    </div>
                </div>

            </div>
        </div>

        <input type="hidden" name="terms" class="input" :value="terms">
    </form>

@endsection

@include('vendor.ueditor.assets')
@section('scripts')

    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container', {
            toolbars: [[
                'fullscreen', 'source', '|', 'undo', 'redo', '|',
                'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
                'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
                'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
                'directionalityltr', 'directionalityrtl', 'indent', '|',
                'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
                'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
                'simpleupload', 'insertimage', 'emotion', 'scrawl', 'insertvideo', 'music', 'attachment', 'map', 'gmap', 'insertframe', 'insertcode', 'webapp', 'pagebreak', 'template', 'background', '|',
                'preview'
            ]]
        });
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', Laravel.csrfToken); // 设置 CSRF token.
        });
    </script>

<script>
    var app = new Vue({
        el: "#app",
        data: {
            title: '{{ $post->title }}',
            slug: '{{ $post->slug }}',
            post_content: '',
            categories:{{ $post->categories->pluck('id') }},
            tags: {{ $post->tags->pluck('id') }},
            api_token: '{{Auth::user()->api_token}}'
        },
        methods:{
            updateSlug: function (val) {
                this.slug = val
            }
        },
        computed: {
            terms: function () {
                console.log(this.categories == "");
                return this.categories + (this.categories == "" || this.tags == "" ? "" : ",") + this.tags
            }
        }
    });
</script>
@endsection
