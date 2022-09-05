<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;

//現在認証されているユーザを取得するためのファサード
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
	//ログインしている時だけアクセスできる
	public function __construct(Cart $cart)
	{
		$this->middleware('auth');
		$this->cart = $cart;
	}

	public function index()
	{
		$id = Auth::id();

		//ログイン者のカート情報を取得
		$carts = Cart::where('user_id', $id)->get();
		$total = $this->total($carts);

		return view('cart.index', compact('carts', 'total'));
	}

	private function total($carts)
	{
		$result = 0;
		foreach ($carts as $cart) {
			$result += $cart->subtotal();
		}
		return $result;
	}

	public function add(Request $request)
	{
		$item_id = $request->input('item_id');
		if ($this->cart->insert($item_id, 1)) {
			return redirect(route('cart.index'))->with('successMessage', '商品をカートに追加しました');
		} else {
			return redirect(route('cart.index'))->with('errorMessage', '在庫が有りません');
		}
	}

	public function remove(Request $request)
	{
		$cart_id = $request->input('cart_id');
		if ($this->cart->remove($cart_id)) {
			return redirect(route('cart.index'))->with('successMessage', 'カートから商品を削除しました');
		} else {
			return redirect(route('cart.index'))->with('errorMessage', 'カートから商品の削除に失敗しました。もう一度お試しください');
		}
	}
}
