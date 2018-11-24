<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::middleware('auth:api')->group( function () {

    Route::get('/posts/unique', 'PostController@apiCheckSlug')->name('api.posts.unique');
    Route::post('/comments/store', 'CommentController@store')->name('api.comments.store');

});

Route::middleware('api')->group( function () {

    Route::get('/posts', 'Api\PostController@index')->name('api.posts.index');

});
