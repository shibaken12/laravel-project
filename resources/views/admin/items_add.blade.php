@extends('layouts.app_admin')

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>商品追加画面</title>
</head>

<body>
    @section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    @foreach ($errors->all() as $error)
                    <font color="red">{{ $error }}</font></br>
                    @endforeach
                    <div class="panel-heading">
                        <h3>追加する商品情報を入力してください</h3>
                    </div>

                    <div class="panel-body">
                        <form action="{{ route('admin.items_db_add') }}" method="post">
                            <!-- laravelでformを使用する場合は{{ csrf_field() }}を使う -->
                            {{ csrf_field() }}
                            <p>商品名：<input type="text" name="item_name"></p>
                            <p>商品説明：<input type="text" name="explanation"></p>
                            <p>値段：<input type="number" name="price"></p>
                            <p>在庫数：<input type="number" name="stock"></p>
                            <input type="submit" value="商品一覧に追加する">
                        </form>
                    </div>
                    <a href="{{ route('admin.items_index') }}">商品一覧に戻る</a>
                </div>
            </div>
        </div>
    </div>
    @endsection
</body>

</html>