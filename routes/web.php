<?php

use App\User;
use App\Http\Resources\User as UserResource;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/mail-preview', function () {
    return new App\Mail\Contact();
});
Route::get('/email', 'HomeController@email')->name('sendEmail');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/blog', 'BlogController@index')->name('blog.index');
Route::get('/blog/{id}', 'BlogController@show')->name('blog.show');

Route::post('/blog/{id}/answer', 'AnswerController@store')->name('blog.answer.store');

Route::get('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::prefix('admin')->group(function (){
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');


    Route::get('/', 'AdminController@index')->name('admin.dashboard');
});

Route::prefix('manage')
    ->middleware('role:superadministrator|administrator|editor')
    ->group(function (){
        Route::get('/', 'ManageController@index')->name('manage.dashboard');
        Route::get('/dashboard', 'ManageController@dashboard')->name('manage.dashboard');

        Route::resource('/users', 'UserController');
        Route::resource('/permissions', 'PermissionController', ['except' => 'destroy']);
        Route::resource('/roles', 'RoleController');

        Route::resource('/posts', 'PostController');
        Route::post('/upload/image', 'UploadController@image')->name('upload.image');

        Route::resource('/terms', 'TermController');
});


Route::get('/json', function (){


    return new App\Http\Resources\User(User::find(1));
});
