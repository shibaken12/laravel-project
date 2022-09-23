@extends('layouts.app')

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>プロフィール編集画面</title>
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
                        <h4>パスワード再設定</h4>
                    </div>

                    <div class="panel-body">
                        <form action="{{ route('user.password_edit', $user->id) }}" method="post">
                            <!-- laravelでformを使用する場合は{{ csrf_field() }}を使う -->
                            {{ csrf_field() }}
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="password" name="current_password">
                                <label class="mdl-textfield__label">現在のパスワード</label>
                            </div>

                            <br>

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="password" name="password">
                                <label class="mdl-textfield__label">新しいパスワード</label>
                            </div>

                            <br>

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="password" name="password_confirmation">
                                <label class="mdl-textfield__label">新しいパスワード(確認用)</label>
                            </div>

                            <br>
                            <br>
                            <br>

                            <input type="submit" value="編集" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                        </form>
                        </br>
                        <a href="{{ route('user.profile', $user->id) }}">アカウント情報に戻る</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</body>

</html>