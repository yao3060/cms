<?php
/**
 * Created by PhpStorm.
 * User: Yao
 * Date: 2018/11/19
 * Time: 11:09
 */
?>

@extends('layouts.manage')

@section('content')

<div class="columns">
    <div class="column">
        <h1 class="title">{{ __('Edit User') }}</h1>
    </div>
</div>

<hr class="m-t-0">

    <div class="columns">
        <div class="column">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                {{ method_field('PUT') }}
                @csrf

                <div class="filed">
                    <label for="name" class="label">{{ __('Name') }}</label>
                    <p class="control">
                        <input type="text" class="input" name="name" id="name" value="{{ $user->name }}">
                    </p>
                </div>

                <div class="field">
                    <label for="email" class="label">{{ __('Email') }}</label>
                    <p class="control">
                        <input type="text" class="input" id="email" name="email" value="{{ $user->email }}">
                    </p>
                </div>

                <div class="field">
                    <label for="roles" class="label">Roles</label>

                    <p class="control">
                        @foreach($roles as $role)
                        <div class="field">
                            <b-checkbox v-model="rolesSelected" :native-value="{{ $role->id }}">{{ $role->display_name }}</b-checkbox>
                        </div>
                        @endforeach
                    </p>
                </div>

                <div class="field">
                    <label for="password" class="label">{{ __('Password') }}</label>

                    <section>
                        <div class="field">
                            <b-radio v-model="password_option" native-value="keep" >Do not Change Password</b-radio>
                        </div>
                        <div class="field">
                            <b-radio v-model="password_option" native-value="auto">Auto-Generate Password</b-radio>
                        </div>
                        <div class="field">
                            <b-radio v-model="password_option" native-value="manual">Manual Set New Password</b-radio>
                            <p class="control m-t-10" v-if="password_option == 'manual'">
                                <input  type="text" class="input" name="password" id="password">
                            </p>
                        </div>
                    </section>

                </div>

                <div class="field">
                    <button class="button is-success">{{ __('Submit') }}</button>
                    <input v-if="rolesSelected != ''" type="hidden" name="roles" :value="rolesSelected">
                </div>


            </form>
        </div>
    </div>

@endsection


@section('scripts')
<script>

    var app = new Vue({
        el: "#app",
        data: {
            password_option: 'keep',
            rolesSelected: {!! $user->roles->pluck('id') !!}
        }
    });

</script>

@endsection

