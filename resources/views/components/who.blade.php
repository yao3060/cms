<?php
/**
 * Created by PhpStorm.
 * User: Yao
 * Date: 2018/11/15
 * Time: 4:25
 */
?>
@if(Auth::guard('web')->check())

    <p class="text-success">You are Logged in as a USER</p>
@else

    <p class="text-danger">You are Logged out as a USER</p>

@endif

@if(Auth::guard('admin')->check())

    <p class="text-success">You are Logged in as a ADMIN</p>
@else

    <p class="text-danger">You are Logged out as a ADMIN</p>

@endif
