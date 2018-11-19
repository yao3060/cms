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
            Administration
        </p>
        <ul class="menu-list">
            <li><a>Team Settings</a></li>
            <li>
                <a class="is-active">Manage Your Team</a>
                <ul>
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
            <li><a href="{{ route('users.index') }}">Users</a></li>
            <li><a href="{{ route('users.index') }}">Role & Permissions</a></li>
            <li><a>Balance</a></li>
        </ul>
    </aside>
</div>
