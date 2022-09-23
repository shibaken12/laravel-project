<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;

use InterventionImage;

class ItemController extends Controller
{
	public function index()
	{
		$item = Item::all();
		//indexビューに$itemの値を渡す
		return view('admin.items_index', compact('item'));
	}

	public function detail(int $id)
	{
		$detail = Item::find($id);

		if ($detail == NULL) {
			return redirect('admin/items_index');
		}
		//viewへ$detailと$idを渡している
		return view('admin.items_detail', compact('detail', 'id'));
	}

	//商品追加フォームページの表示
	public function showAddForm()
	{
		return view('admin.items_add');
	}

	//商品追加ページから送られてきた情報をDBへ保存する
	public function add(Request $request)
	{
		$item = new Item();

		//POST値のバリデーション実施
		//required:入力必須項目
		$request->validate([
			'item_name' => 'required',
			'explanation' => 'required',
			'price' => 'required | integer | between:0,100000000',
			'stock' => 'required | integer | between:0,10000000',
			'image' => 'nullable | file | mimes:jpeg,png,jpg',

		]);

		if ($request->file('image') !== null) {

			// ディレクトリ名
			$dir = 'sample';

			// アップロードされたファイル名を取得
			$file_name = $request->file('image')->getClientOriginalName();

			// 取得したファイル名で保存
			$request->file('image')->storeAs('public/' . $dir, $file_name);

			$path = 'storage/' . $dir . '/' . $file_name;
		} else {
			$path = null;
		}

		$item->create([
			'item_name' => $request->item_name,
			'explanation' => $request->explanation,
			'price' => $request->price,
			'stock' => $request->stock,
			'image' => $path,
		]);

		return redirect('admin/items_index')->with('successMessage', '商品の追加が完了しました');
	}

	//商品編集フォームページの表示
	public function showEditForm(int $id)
	{
		$item = Item::find($id);

		return view('admin.items_edit', compact('item', 'id'));
	}

	public function edit(Request $request, int $id)
	{
		//POST値のバリデーション実施
		$request->validate([
			'item_name' => 'required',
			'explanation' => 'required',
			'stock' => 'required | integer | between:0,10000000',
			'image' => 'nullable | file | mimes:jpeg,png,jpg',
		]);

		$item = Item::find($id);

		if ($request->file('image') !== null) {

			// ディレクトリ名
			$dir = 'sample';

			// アップロードされたファイル名を取得
			$file_name = $request->file('image')->getClientOriginalName();

			$resize_image = InterventionImage::make($request->file('image'));

			$resize_image->resize(
				150,
				150,
				function ($constraint) {
					$constraint->aspectRatio();
				}
			);

			// 取得したファイル名で保存
			$resize_image->save(storage_path('app/public/' . $dir . '/' . $file_name));

			$path = 'storage/' . $dir . '/' . $file_name;
		} else {
			if ($item->image !== null) {
				$path = $item->image;
			} else {
				$path = null;
			}
		}

		Item::where('id', '=', $id)->update([
			'item_name' => $request->item_name,
			'explanation' => $request->explanation,
			'stock' => $request->stock,
			'image' => $path
		]);

		return redirect('admin/items_index')->with('successMessage', '商品の編集が完了しました');
	}
}
