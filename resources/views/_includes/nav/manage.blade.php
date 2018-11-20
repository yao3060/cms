<?php
/**
 * Created by PhpStorm.
 * User: Yao
 * Date: 2018/11/16
 * Time: 15:45
 */
?>

<div class="side-menu">
    <aside class="menu m-t-20 m-l-10">
        <p class="menu-label">
            General
        </p>
        <ul class="menu-list">
            <li><a href="{{ route('manage.dashboard') }}">Dashboard</a></li>
            <li><a>Customers</a></li>
        </ul>
        <p class="menu-label">
            Content
        </p>
        <ul class="menu-list">
            <li><a href="{{ route('posts.index') }}" class="{{ Nav::isResource('posts', '', 'is-active') }}">Posts</a></li>
            <li>
                <a class="has-submenu">Manage Your Team <span class="icon is-pulled-right"><i class="fas fa-angle-right"></i></span></a>
                <ul class="submenu">
                    <li><a>Members</a></li>
                    <li><a>Plugins</a></li>
                    <li><a>Add a member</a></li>
                </ul>
            </li>
            <li><a>Invitations</a></li>
            <li><a>Cloud Storage Environment Settings</a></li>
            <li><a>Authentication</a></li>
        </ul>
        <p class="menu-label">
            Transactions
        </p>
        <ul class="menu-list">
            <li><a class="{{ Nav::isResource('users', '', 'is-active') }}" href="{{ route('users.index') }}">Users</a></li>
            <li><a class="has-submenu" href="#">Role & Permissions <span class="icon is-pulled-right"><i class="fas fa-angle-right"></i></span></a>
                <ul class="submenu">
                    <li><a href="{{route('roles.index')}}" class=" ">Roles</a></li>
                    <li><a href="{{route('permissions.index')}}" class=" ">Permissions</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
