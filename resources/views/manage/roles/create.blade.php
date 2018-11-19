<?php
/**
 * Created by PhpStorm.
 * User: Yao
 * Date: 2018/11/19
 * Time: 21:31
 */
?>

@extends('layouts.manage')

@section('content')

    <div class="columns m-t-10">
        <div class="column">
            <h1 class="title">Create New Role</h1>
        </div>
    </div>
    <hr class="m-t-0">


    <form action="{{route('roles.store')}}" method="POST">
        @csrf

        <div class="columns">
            <div class="column">
                <div class="box">
                    <article class="media">
                        <div class="media-content">
                            <div class="content">
                                <h2 class="subtitle">Role Details:</h2>
                                <div class="field">
                                    <p class="control">
                                        <label for="display_name" class="label">Name (Human Readable)</label>
                                        <input type="text" class="input" name="display_name" value="{{old('display_name')}}" id="display_name">
                                    </p>
                                </div>
                                <div class="field">
                                    <p class="control">
                                        <label for="name" class="label">Slug (Can not be changed)</label>
                                        <input type="text" class="input" name="name" value="{{old('name')}}" id="name">
                                    </p>
                                </div>
                                <div class="field">
                                    <p class="control">
                                        <label for="description" class="label">Description</label>
                                        <input type="text" class="input" value="{{old('description')}}" id="description" name="description">
                                    </p>
                                </div>
                                <input type="hidden" :value="permissionsSelected" name="permissions">
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column">
                <div class="box">
                    <article class="media">
                        <div class="media-content">
                            <div class="content">
                                <h2 class="subtitle">Permissions:</h2>

                                @foreach ($permissions as $permission)
                                    <div class="field">
                                        <b-checkbox
                                            v-model="permissionsSelected"
                                            native-value="{{ $permission->id }}">{{ $permission->display_name }} <em>({{ $permission->description }})</em>
                                        </b-checkbox>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </article>
                </div> <!-- end of .box -->

                <button class="button is-primary">Create new Role</button>
            </div>
        </div>
    </form>

@endsection

@section('scripts')
<script>

    var app = new Vue({
        el: "#app",
        data: {
            permissionsSelected: []
        }
    });

</script>
@endsection
