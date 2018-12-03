<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Proxy\TokenProxy;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public $proxy;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct( TokenProxy $proxy )
    {
        $this->middleware('guest')
            ->except(['logout', 'userLogout']);
        $this->proxy = $proxy;
    }


    public function apiLogin()
    {
        //$this->validateLogin(request());
        //dd(request());
        return $this->proxy->login('password', [
            'username' => request('email')?request('email'):request('username'),
            'password' => request('password'),
            'scope'    => ''
        ]);
    }


    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function userLogout()
    {
        Auth::guard('web')->logout();

        return redirect('/');
    }

}
