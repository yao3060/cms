<?php
/**
 * Created by PhpStorm.
 * User: Yao
 * Date: 2018/11/19
 * Time: 10:55
 */
?>
@extends('layouts.manage')

@section('content')

    <div class="columns">
        <div class="column">
            <h1 class="title">{{ $user->name }}</h1>
            <h4 class="subtitle">{{ __('User Detail') }}</h4>
        </div>
        <div class="column">
            <a href="{{ route('users.edit', $user->id) }}" class="button is-primary is-pulled-right">{{ __('Edit') }}</a>
        </div>
    </div>

    <div class="columns">
        <div class="column is-one-third">
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label for="name" class="label is-pulled-left">{{ __('Name:') }}</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control">
                            <input type="text" class="input is-static" value="{{ $user->name }}">
                        </p>
                    </div>
                </div>
            </div>


            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label for="email" class="label is-pulled-left">{{ __('Email:') }}</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control">
                            <input type="text" class="input is-static" value="{{ $user->email }}">
                        </p>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label for="roles" class="label is-pulled-left">{{ __('Roles:') }}</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control">
                            {{ $user->roles->count() == 0 ? 'This user has not been assigned any roles yet.' : '' }}
                            @foreach($user->roles as $role)
                            <button class="button">{{ $role->display_name }}</button>
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>

        </div>
        <div class="column is-one-third">

        </div>
    </div>
    
@endsection
