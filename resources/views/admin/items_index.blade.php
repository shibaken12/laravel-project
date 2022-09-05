@extends('layouts.app_admin')

@section('content')


<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					@if (session('flash_message'))
					<div class="flash_message">
						<font color="blue">{{ session('flash_message') }}</font>
					</div>
					@endif
					<h2>商品一覧</h2>
					<p align="right"><a href="{{ route('admin.items_add') }}">商品を追加する</a></p>
				</div>

				<div class="panel-body">

					<table class="table table-striped">

						<tr>
							<th>商品名</th>
							<th>値段</th>
							<th>在庫有無</th>
						</tr>

						@foreach ($item as $var)
						<tr>

							<td>
								<a href="{{ route('admin.items_detail', $var->id) }}">{{$var->item_name}}</a>
							</td>

							<td>
								{{$var->price}}
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
	</div>
</div>
@endsection

</html>
