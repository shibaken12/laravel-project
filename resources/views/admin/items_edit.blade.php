@extends('layouts.app_admin')

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>商品編集画面</title>
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
                        <h3>商品情報を編集してください</h3>
                    </div>

                    <div class="panel-body">
                        <form action="{{ route('admin.items_db_edit', $item->id) }}" method="post">
                            <!-- laravelでformを使用する場合は{{ csrf_field() }}を使う -->
                            {{ csrf_field() }}
                            <p>商品名：<input type="text" name="item_name" value="{{ $item->item_name }}"></p>
                            <p>商品説明：<input type="text" name="explanation" value="{{ $item->explanation }}"></p>
                            <p>在庫数：<input type="number" name="stock" value="{{ $item->stock }}"></p>
                            <input type="submit" value="商品を編集する">
                        </form>
                        <a href="{{ route('admin.items_index') }}">商品一覧に戻る</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</body>

</html>