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
                        <h4>追加する商品情報を入力してください</h4>
                    </div>

                    <div class="panel-body">
                        <form action="{{ route('admin.items_db_add') }}" method="post" enctype="multipart/form-data">
                            <!-- laravelでformを使用する場合は{{ csrf_field() }}を使う -->
                            {{ csrf_field() }}
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="text" name="item_name">
                                <label class="mdl-textfield__label">商品名</label>
                            </div>

                            <br>

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="text" name="explanation">
                                <label class="mdl-textfield__label">商品説明</label>
                            </div>

                            <br>

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="number" name="price">
                                <label class="mdl-textfield__label">値段</label>
                            </div>

                            <br>

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="number" name="stock">
                                <label class="mdl-textfield__label">在庫数</label>
                            </div>

                            <br>

                            <p><strong>商品画像</strong></p>
                            <input type="file" name="image">

                            <br>
                            <br>
                            <input type="submit" value="商品一覧に追加する" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                        </form>
                    </div>
                    <br>
                    <a href="{{ route('admin.items_index') }}">商品一覧に戻る</a>
                </div>
            </div>
        </div>
    </div>
    @endsection
</body>

</html>