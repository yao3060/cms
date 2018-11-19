<?php
/**
 * Created by PhpStorm.
 * User: Yao
 * Date: 2018/11/19
 * Time: 12:55
 */
?>
@extends('layouts.manage')

@section('content')

    <div class="columns">
        <div class="column">
            <h1 class="title">Permissions</h1>
        </div>
        <div class="column">
            <a href="{{ route('permissions.create') }}" class="button is-primary is-pulled-right"><i class="fas fa-plus"></i></a>
        </div>
    </div>


    <div class="columns">
        <div class="column">

            <table class="table is-fullwidth">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Display Name</th>
                    <th>slug</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td>{{ $permission->display_name }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->description }}</td>
                        <td>
                            <a href="{{ route('permissions.show', $permission->id) }}" class="button is-info is-small">Show</a>
                            <a href="{{ route('permissions.edit', $permission->id) }}" class="button is-danger is-small">Edit</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

@endsection
