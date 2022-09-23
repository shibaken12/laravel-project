<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\EmailReset;
//自作で作ったバリデーションを使うための記述(現在のパスワード合致確認)
use App\Rules\Current;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
//Str::randomメソッドを使うために宣言
use Illuminate\Support\Str;

use Carbon\Carbon;

class ChangeEmailController extends Controller
{
	public function showAccountForm(int $id)
	{
		$user = User::find($id);
		$user_id = Auth::id();

		if ($user->id !== $user_id) {
			return redirect()->route('user.index');
		}

		return view('user.account_edit', compact('user'));
	}

	public function sendChangeEmailLink(Request $request, int $id)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255',
			'current_password' => new Current(),
		]);

		$user = User::find(Auth::id());
		$new_email = $request->email;
		$new_name = $request->name;

		if ($user->email !== $new_email) {
			//トークンの生成
			$token = hash_hmac(
				'sha256',
				Str::random(40) . $new_email,
				config('app.key')
			);

			//トークンをDBに保存
			DB::beginTransaction();
			try {
				$param = [];
				$param['user_id'] = Auth::id();
				$param['new_email'] = $new_email;
				$param['token'] = $token;
				$email_reset = EmailReset::create($param);
				if ($user->name !== $new_name) {
					$user->name = $new_name;
					$user->save();
				}

				DB::commit();

				//sendEmailResetNotification:モデルで定義
				$email_reset->sendEmailResetNotification($token);

				return redirect()->route('user.profile', $user->id)->with('flash_message', '確認メールを送信しました');
			} catch (\Exception $e) {
				DB::rollback();
				return redirect()->route('user.profile', $user->id)->with('flash_message', 'メールアドレスの更新に失敗しました');
			}
		} else {
			if ($user->name !== $new_name) {
				$user->name = $new_name;
				$user->save();
				return redirect()->route('user.profile', $user->id)->with('flash_message', '名前を変更しました');
			}
		}
	}

	public function reset($token)
	{
		$email_reset = DB::table('email_resets')->where('token', $token)->first();
		$user = User::find($email_reset->user_id);

		//トークンが存在し、かつ、有効期限が切れていなければ
		if ($email_reset && !$this->tokenExpired($email_reset->created_at)) {
			//メールアドレスを新しいものに更新
			$user->email = $email_reset->new_email;
			$user->save();

			//レコードを削除
			DB::table('email_resets')->where('token', $token)->delete();

			return redirect()->route('user.profile', $user->id)->with('flash_message', 'メールアドレスを更新しました。');
		} else {
			//それでもレコードが存在していればエラーとしてレコード削除
			if ($email_reset) {
				DB::table('email_resets')->where('token', $token)->delete();
			}
			return redirect()->route('user.profile', $user->id)->with('flash_message', 'メールアドレスの更新に失敗しました');
		}
	}

	private function tokenExpired($created_at)
	{
		$expires = 60 * 30;
		return Carbon::parse($created_at)->addSeconds($expires)->isPast();
	}
}
