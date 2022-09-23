@extends('layouts.app')

@section('content')

<div class="container">
	<div class="panel panel-default">

		<div class="panel-heading">
			<h4>お届け先住所一覧</h4>
			<p align=" right">
				<a href="{{ route('address.register_form') }}" class="mdl-button mdl-js-button mdl-button--accent">お届け先住所を登録する</a>
			</p>
		</div>

		<div class="panel-body">
			@if ($address->count() == 0)
			<h3>お届け先住所を登録してください</h3>

			@else
			<table class="table table-striped" style="width: 100%;">

				<tr>
					<th>選択</th>
					<th>氏名</th>
					<th>郵便番号</th>
					<th>都道府県</th>
					<th>市区町村</th>
					<th>番地等</th>
					<th>電話番号</th>
					<th>編集</th>
					<th>削除</th>
				</tr>

				@foreach ($address as $var)
				<tr>

					<td>
						<!-- ボタンの名前を全て同じnameにしてあげることで一つだけの選択をさせることができる -->
						<input type="radio" name="select">
					</td>

					<td>
						{{ $var->name }}
					</td>

					<td>
						{{ $var->postcode }}
					</td>

					<td>
						{{ $var->ken_name }}
					</td>

					<td>
						{{ $var->city_name }}
					</td>

					<td>
						{{ $var->town_memo }}
					</td>

					<td>
						{{ $var->phone_num }}
					</td>

					<td>
						<a href="{{ route('address.edit_form', $var->id) }}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">編集</a>
					</td>

					<td>
						<a href="{{ route('address.delete', $var->id) }}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">削除</a>
					</td>

				</tr>
				@endforeach
				@endif
			</table>

			<a href="{{ route('item.index') }}">商品一覧に戻る</a>
		</div>
	</div>
</div>
@endsection

</html>