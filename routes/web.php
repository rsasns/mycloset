<?php

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

Route::get('/', 'CordinatesController@index')->name('index');
Route::get('/feed', 'CordinatesController@feed')->name('feed');


// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// ログイン認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

// ログイン時の処理
Route::group(['middleware' => ['auth']], function () {
    // ユーザ編集機能
    Route::resource('users', 'UsersController', ['only' => ['edit', 'update', 'destroy']]);
    // 投稿機能
    Route::resource('cordinates', 'CordinatesController', ['only' => ['create', 'store', 'edit', 'update','destroy']]);
    // コメント機能
    Route::post('cordinates/{id}', 'CommentsController@store')->name('comments.store');
    Route::delete('cordinates/{id}/comment', 'CommentsController@destroy')->name('comments.destroy');

    // フォロー機能、クリップ一覧表示の処理
    Route::group(['prefix' => 'users/{user_id}'], function () {
        Route::post('follow', 'UserFollowController@store')->name('user.follow');
        Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
        Route::get('followings', 'UsersController@followings')->name('users.followings');
        Route::get('followers', 'UsersController@followers')->name('users.followers');
        Route::get('favorites', 'UsersController@favorites')->name('users.favorites');
    });
    // クリップ機能、いいね機能の処理
    Route::group(['prefix' => 'cordinates/{id}'], function () {
        Route::post('favorite', 'FavoritesController@store')->name('user.favorite');
        Route::delete('unfavorite', 'FavoritesController@destroy')->name('user.unfavorite');
        Route::post('onnice', 'NiceController@store')->name('user.onnice');
        Route::delete('unnice', 'NiceController@destroy')->name('user.unnice');
    });
});

// 制限なしの処理
Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
Route::resource('cordinates', 'CordinatesController', ['only' => ['index', 'show']]);