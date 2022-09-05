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

use App\Http\Controllers\CartController;

Auth::routes();

//商品一覧を表示させるルーティング
Route::get('/', 'ItemController@index')->name('item.index');

//商品詳細画面を表示させるルーティング
//item/detail/{item_id}にアクセスしたらItemControllerのdetailアクションを実行
Route::get('item/detail/{id}', 'ItemController@detail')->name('item.detail');

//Userがログイン後認証していれば表示する画面へのルーティング
Route::group(['middleware' => 'auth:user'], function () {
	Route::get('/user/index', 'ItemController@index')->name('user.index');

	//カート画面へのルーティング
	Route::get('/cart/index', 'CartController@index')->name('cart.index');

	Route::post('/cart/add', 'CartController@add')->name('cart.add');

	Route::post('/cart/remove', 'CartController@remove')->name('cart.remove');
});

//Adminが認証不要でアクセスできる画面へのルーティング
Route::group(['prefix' => 'admin'], function () {
	Route::get('/', function () {
		return redirect('/admin/login');
	});
	Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
	Route::post('login', 'Admin\LoginController@login');
});

//Adminがログイン後アクセスできる画面へのルーティング
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
	Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');

	Route::get('items_index', 'Admin\ItemController@index')->name('admin.items_index');

	Route::get('items_detail/{id}', 'Admin\ItemController@detail')->name('admin.items_detail');

	Route::get('items_add', 'Admin\ItemController@showAddForm')->name('admin.items_add');
	Route::post('items_db_add', 'Admin\ItemController@add')->name('admin.items_db_add');

	Route::get('items_edit/{id}', 'Admin\ItemController@showEditForm')->name('admin.items_edit');
	Route::post('items_db_edit/{id}', 'Admin\ItemController@edit')->name('admin.items_db_edit');
});
