@extends('layouts.app')

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>アカウント情報再設定</title>
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
                        <h4>アカウント情報再設定</h4>
                    </div>

                    <div class="panel-body">
                        <form action="{{ route('account.send_email', $user->id) }}" method="post">
                            {{ csrf_field() }}
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="text" name="name" value="{{ $user->name }}">
                                <label class="mdl-textfield__label">名前</label>
                            </div>

                            <br>

                            <small>※新しいメールアドレスに確認用メールを送信します。</small>
                            <br>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="email" name="email" value="{{ $user->email }}">
                                <label class="mdl-textfield__label">メールアドレス</label>
                            </div>

                            <br>

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="password" name="current_password">
                                <label class="mdl-textfield__label">現在のパスワード</label>
                            </div>

                            <br>
                            <br>

                            <input type="submit" value="プロフィール編集" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                        </form>
                        </br>
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