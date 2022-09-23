<?php

namespace App\Http\Controllers\Address;

use Illuminate\Http\Request;
use App\Address;

//extendsで継承するために宣言
use App\Http\Controllers\Controller;

//現在認証されているユーザを取得するためのファサード
use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\Rule;

class AddressController extends Controller
{

	public function __construct()
	{
		//ログインしている時だけアクセスできるように
		$this->middleware('auth');
	}

	public function index()
	{
		$user_id = Auth::id();
		$address = Address::where('user_id', $user_id)->get();

		return view('address.index', compact('address'));
	}

	public function showRegisterForm()
	{
		return view('address.register');
	}

	public function register(Request $request)
	{
		$address = new Address();
		$user_id = Auth::id();

		$request->validate([
			'name' => 'required',
			'postcode' => 'required | digits:7',
			'ken_name' => 'required',
			'city_name' => 'required',
			// 'town_memo' => ['required', Rule::unique('addresses')->where('user_id', $user_id)],
			'town_memo' => ['required', Rule::unique('addresses')->where(static function ($query) {
				$user_id = Auth::id();
				return $query->where('user_id', $user_id)->whereNull('deleted_at');
			})],
			'phone_num' => 'required | digits_between:10,11',
		]);

		$address->create([
			'user_id' => $user_id,
			'name' => $request->name,
			'postcode' => $request->postcode,
			'ken_name' => $request->ken_name,
			'city_name' => $request->city_name,
			'town_memo' => $request->town_memo,
			'phone_num' => $request->phone_num,
		]);

		return redirect('address/index');
	}

	public function showEditForm(int $id)
	{
		//ログイン者以外の情報へのアクセスを制限
		$user_id = Auth::id();
		$address = Address::find($id);

		if ($user_id !== $address->user_id) {
			return redirect('address/index');
		}

		return view('address.edit', compact('address'));
	}

	public function edit(Request $request, int $id)
	{
		//ログイン者以外の情報へのアクセスを制限
		$user_id = Auth::id();
		$address = Address::find($id);

		if ($user_id !== $address->user_id) {
			return redirect('address/index');
		}

		$request->validate([
			'name' => 'required',
			'postcode' => 'required | digits:7',
			'ken_name' => 'required',
			'city_name' => 'required',
			'town_memo' => ['required', Rule::unique('addresses')->ignore($address->id)->where(static function ($query) {
				return $query->whereNull('deleted_at');
			})],
			'phone_num' => 'required | digits_between:10,11',
		]);

		Address::where('id', $id)->update([
			'name' => $request->name,
			'postcode' => $request->postcode,
			'ken_name' => $request->ken_name,
			'city_name' => $request->city_name,
			'town_memo' => $request->town_memo,
			'phone_num' => $request->phone_num,
		]);

		return redirect('address/index');
	}

	public function delete(int $id)
	{
		//ログイン者以外の情報へのアクセスを制限
		$user_id = Auth::id();
		$get_address = Address::find($id);

		if ($user_id !== $get_address->user_id) {
			return redirect('address/index');
		}
		$address = new Address();
		$address->where('id', $id)->delete();

		return redirect('address/index');
	}
}
