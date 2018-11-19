<?php
/**
 * Created by PhpStorm.
 * User: Yao
 * Date: 2018/11/19
 * Time: 20:23
 */

?>

@extends('layouts.manage')

@section('content')

    <div class="columns">
        <div class="column">
            <h1 class="title">{{ $permission->display_name }}</h1>
            <p class="subtitle">{{ $permission->description }}</p>
        </div>
        <div class="column">

            <div class="buttons are-small is-pulled-right">
                <a href="{{ route('permissions.edit', $permission->id) }}" class="button is-info">{{ __('Edit') }}</a>
                <a href="{{ route('permissions.index') }}" class="button">{{ __('All Permissions') }}</a>
            </div>
        </div>
    </div>


@endsection
