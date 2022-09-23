@extends('layouts.app')

@section('content')
<!-- 郵便番号から自動で住所入力してくれるJavaScript -->
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				@foreach ($errors->all() as $error)
				<font color="red">{{ $error }}</font></br>
				@endforeach
				<div class="panel-heading">
					<h5>新規追加したいお届け先住所を登録してください</h5>
				</div>

				<div class="panel-body">
					<form action="{{ route('address.register') }}" method="post">
						<!-- laravelでformを使用する場合は{{ csrf_field() }}を使う -->
						{{ csrf_field() }}
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
							<input class="mdl-textfield__input" type="text" name="name">
							<label class="mdl-textfield__label">氏名</label>
						</div>

						<br>

						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
							<input class="mdl-textfield__input" type="number" name="postcode" onKeyUp="AjaxZip3.zip2addr(this, '', 'ken_name', 'city_name', 'town_memo');">
							<label class="mdl-textfield__label">郵便番号</label>
						</div>
						<small>※ハイフンなし</small>


						<br>

						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
							<input class="mdl-textfield__input" type=" text" name="ken_name">
							<label class="mdl-textfield__label">都道府県</label>
						</div>

						<br>

						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
							<input class="mdl-textfield__input" type="text" name="city_name">
							<label class="mdl-textfield__label">市区町村</label>
						</div>

						<br>

						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
							<input class="mdl-textfield__input" type="text" name="town_memo">
							<label class="mdl-textfield__label">番地等</label>
						</div>

						<br>

						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
							<input class="mdl-textfield__input" type="tel" name="phone_num">
							<label class="mdl-textfield__label">電話番号</label>
						</div>
						<small>※ハイフンなし</small>


						<br>

						<input type="submit" value="お届け先住所を登録する" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
					</form>
				</div>
				<a href="{{ route('address.index') }}">お届け先一覧に戻る</a>
			</div>
		</div>
	</div>
</div>
@endsection

</html>