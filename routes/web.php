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

Auth::routes();

//Userがログイン後認証していれば表示する画面へのルーティング
Route::group(['middleware' => 'auth:user'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
});

//商品一覧を表示させるルーティング
Route::get('/', 'ItemController@index');

//商品詳細画面を表示させるルーティング
//item/detail/{item_id}にアクセスしたらItemControllerのdetailアクションを実行
Route::get('item/detail/{id}', 'ItemController@detail')->name('item.detail');

//Adminが認証不要でアクセスできる画面へのルーティング
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', function () {
        return redirect('/admin/home');
    });
    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login');
});

//Adminがログイン後アクセスできる画面へのルーティング
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');
    Route::get('home', 'Admin\HomeController@index')->name('admin.home');
});
