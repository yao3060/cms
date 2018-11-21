<?php
/**
 * Created by PhpStorm.
 * User: Yao
 * Date: 2018/11/21
 * Time: 20:49
 */
?>

@if (Session::has('success'))

    <div class="notification is-success" role="alert">
        <button class="delete"></button>
        <strong>Success:</strong> {{ Session::get('success') }}
    </div>

@endif

@if (count($errors) > 0)

    <div class="notification alert-danger" role="alert">
        <button class="delete"></button>
        <strong>Errors:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endif
