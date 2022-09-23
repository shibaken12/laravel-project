@extends('layouts.app_admin')

@section('content')

@if (session('successMessage'))
<p class="alert alert-success text-center">{{ session('successMessage')}}</p>
@endif

<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4>商品一覧</h4>
			<p align="right"><a href="{{ route('admin.items_add') }}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">商品を追加する</a></p>
		</div>

		<div class="panel-body">

			<table class="table table-striped">

				<tr>
					<th>商品名</th>
					<th>商品画像</th>
					<th>値段</th>
					<th>在庫有無</th>
				</tr>

				@foreach ($item as $var)
				<tr>

					<td>
						<a href="{{ route('admin.items_detail', $var->id) }}">{{$var->item_name}}</a>
					</td>

					@if ($var->image == null)
					<td>
						<strong>未登録</strong>
					</td>

					@else
					<td>
						<img src="{{ asset($var->image) }}">
					</td>
					@endif

					<td>
						{{ '¥' . number_format($var->price) }}
					</td>

					@if ($var->stock == 0)
					<td>
						{{'在庫なし'}}
					</td>

					@else
					<td>
						{{'在庫あり'}}
					</td>
					@endif

				</tr>
				@endforeach

			</table>
		</div>
	</div>
</div>
@endsection

</html>