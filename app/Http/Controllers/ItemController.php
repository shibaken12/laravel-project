<?php

namespace App\Http\Controllers;

use A;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Item;

//現在認証されているユーザを取得するためのファサード
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
	public function index()
	{
		$item = Item::all();
		$session = Auth::id();
		//indexビューに$itemの値を渡す
		return view('index', compact('item', 'session'));
	}

	public function detail(int $id)
	{
		$detail = Item::find($id);
		$session = Auth::id();

		if ($detail == NULL) {
			return redirect('/');
		}
		return view('item.detail', compact('detail', 'id', 'session'));
	}
}
