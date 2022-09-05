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
					<h2>カート一覧</h2>
					<p align="right">合計金額 ¥ {{ $total }}</p>
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
								{{ $var->item->price }}
							</td>

							<td>
								{{ $var->quantity }}
							</td>

							<td>
								{{ $var->item->price * $var->quantity }}
							</td>

							<td>
								<form method="post" action="{{ route('cart.remove') }}">
									{{ csrf_field() }}
									<input type="hidden" name="cart_id" value="{{ $var->id }}">
									<input type="submit" value="カートから削除する">
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
