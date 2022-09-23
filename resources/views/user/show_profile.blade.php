@extends('layouts.app')

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<title>アカウント情報</title>
</head>

<body>
	@section('content')
	<div class="container">
		{{-- display message --}}
		@if (session('flash_message'))
		<strong>{{ session('flash_message') }}</strong>
		@endif
		<br>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4>アカウント情報</h4>
					</div>

					<div class="panel-body">
						<h6>名前：</br></h6>
						<h5><strong>{{ $user->name }}</strong></h5>
						<h6>メールアドレス：</br></h6>
						<h5><strong>{{ $user->email }}</strong></h5>
						</br>
						</br>

						<div style="text-align:center">
							<a href="{{ route('user.account', $user->id) }}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">アカウント情報の再設定</a>
							<a href="{{ route('user.password', $user->id) }}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">パスワードの再設定</a>
							</br>
						</div>
						</br>
						</br>
						<a href="{{ route('user.index') }}">商品一覧に戻る</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection
</body>

</html>
