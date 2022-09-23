<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;

//自作で作ったバリデーションを使うための記述(現在のパスワード合致確認)
use App\Rules\Current;

//現在認証されているユーザを取得するためのファサード
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
	public function showInfo(int $id)
	{
		$user = User::find($id);
		$user_id = Auth::id();

		if ($user->id !== $user_id) {
			return redirect()->route('user.index');
		}

		return view('user.show_profile', compact('user'));
	}

	public function showPasswordForm(int $id)
	{
		$user = User::find($id);
		$user_id = Auth::id();

		if ($user->id !== $user_id) {
			return redirect()->route('user.index');
		}

		return view('user.password_edit', compact('user'));
	}

	public function editPassword(Request $request, int $id)
	{
		$request->validate([
			'current_password' => new Current(),
				'password' => 'nullable | string | min:6 | confirmed',
			]);

		//フォームに何もなければ、DBの情報を格納
		if ($request->password == null) {
			$request->password = Auth::user()->password;
		} else {
			//フォームに新しいパスワードがあれば、記入されたものをハッシュ化して格納
			$request->password = bcrypt($request->password);
		}

		User::where('id', $id)->update([
			'password' => $request->password,
		]);
		return redirect('user/index');
	}
}
