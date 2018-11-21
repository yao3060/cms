@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 m-t-20">
            <div class="card">
                <div class="card-header" :title="title">
                    <p class="card-header-title" v-text="title"></p>
                </div>

                <div class="card-content">
                    <div class="content">

                        @component('components.who')
                        @endcomponent
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            <p>
                                Link <a href="#">URL</a>
                            </p>

                            <input type="text" class="input" v-model="url">

                            <button @click="humanizeUrl" class="button">Humanize me</button>

                    </div>
                </div>

                <footer class="card-footer">
                    <a href="#" class="card-footer-item">Save</a>
                    <a href="#" class="card-footer-item">Edit</a>
                    <a href="#" class="card-footer-item">Delete</a>
                </footer>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

    <script>

        var app = new Vue({
            el: "#app",
            data: {
                url: '',
                count: 1,
                title: 'User Dashboard Hello World',
                message: 'Hello World',
                todos: [
                    { text: 'learn vue'},
                    { text: 'learn vue 2'},
                    { text: 'learn vue 3'},
                ]
            },
            methods: {
                humanizeUrl: function () {
                    this.url = '';
                }
            }
        });

    </script>

@endsection
