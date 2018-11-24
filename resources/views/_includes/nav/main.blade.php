<?php
/**
 * Created by PhpStorm.
 * User: Yao
 * Date: 2018/11/16
 * Time: 15:48
 */
?>

<nav class="navbar has-shadow" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="/">
            {{ config('app.name', 'Laravel') }}
        </a>

        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="/">{{ __('Home') }}</a>

            <a class="navbar-item is-active" href="{{ route('blog.index') }}">{{ __('Blog') }}</a>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                    More
                </a>

                <div class="navbar-dropdown">
                    <a class="navbar-item">
                        About
                    </a>
                    <a class="navbar-item">
                        Jobs
                    </a>
                    <a class="navbar-item">
                        Contact
                    </a>
                    <hr class="navbar-divider">
                    <a class="navbar-item">
                        Report an issue
                    </a>
                </div>
            </div>
        </div>

        <div class="navbar-end">
            <div class="navbar-item">

                <!-- Authentication Links -->
                @guest
                    <div class="buttons">
                        <a class="button is-light" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @if (Route::has('register'))
                            <a class="button is-primary" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    </div>
                @else

                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link">
                            {{ Auth::user()->name }}
                        </a>

                        <div class="navbar-dropdown">


                            <a class="navbar-item">
                                Profile
                            </a>
                            <a class="navbar-item">
                                Notifications
                            </a>
                            <a class="navbar-item">
                                Settings
                            </a>

                            <a class="navbar-item" href="{{ route('manage.dashboard') }}">
                                {{ __('Dashboard') }}
                            </a>

                            <hr class="navbar-divider">
                            <a class="navbar-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>

                @endguest

            </div>
        </div>
    </div>
</nav>

