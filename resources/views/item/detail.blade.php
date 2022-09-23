@extends('layouts.app')

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>商品詳細画面</title>
</head>

<body>


    @section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>商品詳細</h2>
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped">

                            <tr>
                                <th>商品名</th>
                                <th>商品説明</th>
                                <th>値段</th>
                                <th>在庫の有無</th>
                                <th>カートに追加</th>
                            </tr>

                            <tr>

                                <td>
                                    {{$detail->item_name}}
                                </td>

                                <td>
                                    {{$detail->explanation}}
                                </td>

                                <td>
                                    {{'¥' . number_format($detail->price)}}
                                </td>

                                @if ($detail->stock == 0)
                                <td>
                                    {{'在庫なし'}}
                                </td>

                                @else
                                <td>
                                    {{'在庫あり'}}
                                </td>
                                @endif

                                @if ($detail->stock !==0 && !$session)
                                <td>
                                    {{'ログインしてください'}}
                                </td>

                                @elseif ($detail->stock ==0)
                                <td>
                                    {{'在庫なし'}}
                                </td>

                                @else
                                <td>
                                    <form method="post" action="{{ route('cart.add') }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="item_id" value="{{ $detail->id }}">
                                        <input type="submit" value="カートに追加する" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                                    </form>
                                </td>
                                @endif

                            </tr>

                        </table>
                        <td>
                            <img src="{{ asset($detail->image) }}">
                        </td>
                    </div>
                    <a href="{{ route('item.index') }}">商品一覧に戻る</a>
                </div>
            </div>
        </div>
    </div>
    @endsection
</body>

</html>