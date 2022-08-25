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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//商品一覧を表示させるルーティング
Route::get('/', 'ItemController@index');

//商品詳細画面を表示させるルーティング
//item/detail/{item_id}にアクセスしたらItemControllerのdetailアクションを実行
Route::get('item/detail/{id}', 'ItemController@detail')->name('item.detail');
