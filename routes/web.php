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
use App\Http\Controllers\Address\AddressController;

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


	//お届け先住所へのルーティング
	Route::get('/address/index', 'Address\AddressController@index')->name('address.index');

	Route::get('/address/register', 'Address\AddressController@showRegisterForm')->name('address.register_form');
	Route::post('/address/db_register', 'Address\AddressController@register')->name('address.register');

	Route::get('/address/edit/{id}', 'Address\AddressController@showEditForm')->name('address.edit_form');
	Route::post('/address/db_edit/{id}', 'Address\AddressController@edit')->name('address.edit');

	Route::get('/address/delete/{id}', 'Address\AddressController@delete')->name('address.delete');

	//プロフィール編集画面へのルーティング
	Route::get('/user/info/{id}', 'User\ProfileController@showInfo')->name('user.profile');
	//パスワード変更画面へのルーティング
	Route::get('/user/password/{id}', 'User\ProfileController@showPasswordForm')->name('user.password');
	Route::post('/user/password_edit/{id}', 'User\ProfileController@editPassword')->name('user.password_edit');
	//アカウント情報編集へのルーティング
	Route::get('/user/account/{id}', 'User\ChangeEmailController@showAccountForm')->name('user.account');
	Route::post('/user/account_edit/{id}', 'User\ChangeEmailController@sendChangeEmailLink')->name('account.send_email');
	Route::get('/email/reset/{token}', 'User\ChangeEmailController@reset')->name('account.change_email');
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

	//会員一覧
	Route::get('user/index', 'Admin\UserController@index')->name('admin.user_index');
	Route::get('user/detail/{id}', 'Admin\UserController@detail')->name('admin.user_detail');
});
