<?php
/**
 * Created by PhpStorm.
 * User: Yao
 * Date: 2018/11/21
 * Time: 20:13
 */
?>
@extends('layouts.manage')

@section('content')

    <h1 class="title">Terms</h1>

    <div class="columns">
        <div class="column is-two-thirds">

            <table class="table is-fullwidth">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Taxonomy</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($terms as  $term)

                    <tr>
                        <td>{{ $term->id }}</td>
                        <td>{{ $term->name }}</td>
                        <td>{{ $term->taxonomy }}</td>
                        <td>
                            <span class="buttons is-pulled-right">
                                <form action="{{ route('terms.destroy', $term->id) }}" method="POST">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button class="button is-small is-danger">Delete</button>
                                </form>
                            </span>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="column"></div>
    </div>

@endsection
