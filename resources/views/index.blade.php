@extends('layouts.app')

@section('content')


<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>商品一覧</h4>
            @if ($session)
            <p align="right">
                <a href="{{ route('cart.index') }}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">カート一覧へ</a>
            </p>
            @endif
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
                        <a href="{{ route('item.detail', $var->id) }}">{{$var->item_name}}</a>
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