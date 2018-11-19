<?php
/**
 * Created by PhpStorm.
 * User: Yao
 * Date: 2018/11/19
 * Time: 20:52
 */
?>
@extends('layouts.manage')

@section('content')

    <div class="columns">
        <div class="column">
            <h1 class="title">Role {{ $role->display_name }}
                <small class="is-small is-text is-light">({{ $role->name }})</small>
            </h1>
            <p class="subtitle">{{ $role->description }}</p>
            <hr>
            <h2 class="subtitle">Permissions:</h2>

            @foreach($role->permissions as $permission)

                <button class="button is-small">{{ $permission->display_name }}</button>

            @endforeach

        </div>
        <div class="column"></div>
    </div>

    <hr>

    <form action="{{ route('roles.update', $role->id) }}" method="POST">
        @csrf
        {{ method_field('PUT') }}
        <div class="columns">

            <div class="column is-one-third">

                <h2 class="subtitle">Edit Role</h2>

                <div class="field">
                    <label for="display_name" class="label">Display Name</label>
                    <p class="control">
                        <input type="text" name="display_name" class="input" id="display_name"
                               value="{{ $role->display_name }}">
                    </p>
                </div>

                <div class="field">
                    <label for="name" class="label">Slug</label>
                    <p class="control">
                        <input type="text" name="name" class="input" id="name" value="{{ $role->name }}"
                               disabled="disabled">
                    </p>
                </div>


                <div class="field">
                    <label for="description" class="label">Description</label>
                    <p class="control">
                        <input type="text" name="description" class="input" id="description"
                               value="{{ $role->description }}">
                    </p>
                </div>

                <div class="field">
                    <button class="button is-primary">Submit</button>
                    <input v-if="permissionsSelected != ''" type="hidden" :value="permissionsSelected" name="permissions">
                </div>

            </div>

            <div class="column">

                <h2 class="subtitle">Permissions:</h2>

                <section>
                    @foreach($permissions as $permission)
                        <div class="field">
                            <b-checkbox v-model="permissionsSelected" :native-value="{{ $permission->id }}">
                                {{ $permission->display_name }} <em>({{ $permission->description }})</em>
                            </b-checkbox>
                        </div>
                    @endforeach
                </section>
            </div>
        </div>
    </form>
@endsection


@section('scripts')
    <script>

        var app = new Vue({
            el: "#app",
            data: {
                permissionsSelected: {!! $role->permissions->pluck('id') !!}
            }
        });
    </script>

@endsection
