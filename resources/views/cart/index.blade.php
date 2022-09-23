@extends('layouts.app')

@section('content')


<div class="container">
	@if (session('successMessage'))
	<p class="alert alert-success text-center">{{ session('successMessage')}}</p>
	@elseif (session('errorMessage'))
	<p class="alert alert-danger text-center">{{ session('errorMessage')}}</p>
	@endif
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>カート一覧</h4>
					<p align="right"><a href="{{ route('address.index') }}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">お届け先を選択</a></p>
					<h6 align="right"><strong>合計金額 ¥ {{ number_format($total) }}</strong></h6>
				</div>

				<div class="panel-body">
					@if ($carts->count() == 0)
					<h3 align="center">カートは空です</h3>

					@else
					<table class="table table-striped">

						<tr>
							<th>商品名</th>
							<th>値段</th>
							<th>購入数</th>
							<th>小計</th>
							<th>削除</th>
						</tr>

						@foreach ($carts as $var)
						<tr>

							<td>
								{{ $var->item->item_name }}
							</td>

							<td>
								{{ '¥' . number_format($var->item->price) }}
							</td>

							<td>
								{{ $var->quantity }}
							</td>

							<td>
								{{ '¥' . number_format($var->item->price * $var->quantity) }}
							</td>

							<td>
								<form method="post" action="{{ route('cart.remove') }}">
									{{ csrf_field() }}
									<input type="hidden" name="cart_id" value="{{ $var->id }}">
									<input type="submit" value="カートから削除する" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
								</form>
							</td>

						</tr>
						@endforeach
						@endif

					</table>
					<a href="{{ route('item.index') }}">商品一覧に戻る</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

</html>