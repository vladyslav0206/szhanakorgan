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

/******* Admin page *******/
Route::group([
    'namespace' => 'API',
], function() {

    Route::group([
        'prefix' => 'auth',
    ], function() {
        Route::post('register', 'AuthController@register');
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('send/confirm', 'AuthController@sendConfirmToEmail');
        Route::post('password', 'ProfileController@editPassword');
        Route::post('password/forget', 'AuthController@forgetPassword');
    });

    Route::group([
        'prefix' => 'profile',
    ], function() {
        Route::get('/', 'ProfileController@getProfile');
        Route::post('/', 'ProfileController@editProfile');
        Route::post('avatar', 'ProfileController@uploadAvatar');
    });
    
    Route::group([
        'prefix' => 'push',
    ], function() {
        Route::post('/', 'PushController@addDevice');
        Route::post('send', 'PushController@sendPush');
        Route::delete('push', 'PushController@deleteDevice');
    });

    Route::group([
        'prefix' => 'comment',
    ], function() {
        Route::get('/', 'CommentController@getCommentList');
        Route::post('/', 'CommentController@addComment');
        Route::post('like', 'CommentController@likeComment');
    });

    Route::get('rubric', 'RubricController@getRubricList');
    Route::get('currency', 'NewsController@getMoneyRates');
    Route::get('news', 'NewsController@getNewsList');
    Route::get('news/{id}', 'NewsController@getNewsById');
});
