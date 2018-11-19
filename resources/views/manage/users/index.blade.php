<?php
/**
 * Created by PhpStorm.
 * User: Yao
 * Date: 2018/11/19
 * Time: 0:00
 */
?>

@extends('layouts.manage')

@section('content')

    <div class="columns">
        <div class="column">
            <h1 class="title">{{ __('Manage Users') }}</h1>
        </div>
        <div class="column">
            <a href="{{ route('users.create') }}" title="{{ __('Add user') }}" class="button is-primary is-pulled-right"><i class="fas fa-plus"></i></a>
        </div>
    </div>

    <table class="table is-fullwidth is-striped is-hoverable">
        <thead>
            <tr>
                <th width="60px">ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Create At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Create At</th>
                <th>Actions</th>
            </tr>
        </tfoot>
        <tbody>
        @foreach($users as $user)
        <tr>
            <th>{{ $user->id }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at->diffForHumans() }}</td>
            <td>
                <a href="{{ route('users.show', $user->id) }}" class="button is-small">View</a>
                <a href="{{ route('users.edit', $user->id) }}" class="button is-small">Edit</a>
                <a href="{{ route('users.destroy', $user->id) }}" class="button is-small">Delete</a>
            </td>
       </tr>
        @endforeach
        </tbody>
    </table>

    {{ $users->links() }}








@endsection
