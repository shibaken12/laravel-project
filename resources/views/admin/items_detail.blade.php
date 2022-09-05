@extends('layouts.app_admin')

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
                        <p align="right"><a href="{{ route('admin.items_edit', $detail->id) }}">編集する</a></p>
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped">

                            <tr>
                                <th>商品名</th>
                                <th>商品説明</th>
                                <th>値段</th>
                                <th>在庫の有無</th>
                            </tr>

                            <tr>

                                <td>
                                    {{$detail->item_name}}
                                </td>

                                <td>
                                    {{$detail->explanation}}
                                </td>

                                <td>
                                    {{$detail->price}}
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

                            </tr>

                        </table>
                    </div>
                    <a href="{{ route('admin.items_index') }}">商品一覧に戻る</a>
                </div>
            </div>
        </div>
    </div>
    @endsection
</body>

</html>