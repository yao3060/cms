<?php
/**
 * Created by PhpStorm.
 * User: Yao
 * Date: 2018/11/19
 * Time: 20:47
 */
?>
@extends('layouts.manage')

@section('content')

    <div class="columns">
        <div class="column">
            <h1 class="title">{{ __('Roles') }}</h1>
        </div>
        <div class="column">
            <div class="is-pulled-right"><a href="{{ route('roles.create') }}" class="button">Add Role</a></div>
        </div>
    </div>

    <div class="columns">
        <div class="column">

            <table class="table is-fullwidth">
                <thead>
                <tr>
                    <th>Display Name</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                <tr>
                    <td>{{ $role->display_name }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->description }}</td>
                    <td >
                        <span class="buttons are-small">
                        <a href="{{ route('roles.edit', $role->id) }}" class="button">Edit</a>
                        <a href="{{ route('roles.destroy', $role->id) }}" class="button is-danger">Delete</a>
                            </span>
                    </td>
                </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

@endsection
