<?php

namespace App\Http\Controllers;

use A;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Item;

class ItemController extends Controller
{
	public function index() {
		$item = Item::all();
		//indexビューに$itemの値を渡す
        return view('index', compact('item'));
	}

	public function detail(int $id) {
		$detail = Item::find($id);
		return view('item.detail', compact('detail', 'id'));
	}
}