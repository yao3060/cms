<?php
/**
 * Created by PhpStorm.
 * User: Yao
 * Date: 2018/11/19
 * Time: 10:16
 */
?>
@extends('layouts.manage')

@section('content')

    <div class="columns m-t-10">
        <div class="column">
            <h1 class="title">{{ __('Create New User') }}</h1>
        </div>
    </div>

    <hr class="m-t-10">

            <form action="{{ route('users.store') }}" method="POST">
                @csrf
    <div class="columns">
        <div class="column">

                <div class="field">
                    <label for="name" class="label">{{ __('Name') }}</label>
                    <p class="control">
                        <input type="text" class="input" name="name" id="name">
                    </p>
                </div>

                <div class="field">
                    <label for="email" class="label">{{ __('email') }}</label>
                    <p class="control">
                        <input type="text" class="input" name="email" id="email">
                    </p>
                </div>

                <div class="field">
                    <label for="password" class="label">{{ __('Password') }}</label>
                    <p class="control">
                        <input type="text" class="input" name="password" id="password" v-if="!auto_password">
                        <b-checkbox v-model="auto_password" class="m-t-10" name="auto_generate">{{ __('Auto Generate Password') }}</b-checkbox>
                    </p>
                </div>



        </div>

        <div class="column">

            <div class="field">
                <label for="roles" class="label">Roles</label>
                <p class="control">
                    @foreach( $roles as $role )

                    <div class="field">
                        <b-checkbox v-model="rolesSelected" :native-value="{{ $role->id }}">
                            {{ $role->display_name }}
                        </b-checkbox>
                    </div>

                    @endforeach
                </p>
            </div>

        </div>
    </div>

                <hr>

                <div class="field">
                    <button class="button is-primary">{{ __('Submit') }}</button>
                    <input v-if="rolesSelected != ''" type="text" name="roles" :value="rolesSelected">
                </div>

            </form>

@endsection

@section('scripts')
<script>

    var app = new Vue({
        el: "#app",
        data: {
            auto_password: true,
            rolesSelected: []
        }
    });

</script>
@endsection

