@extends('layouts.app_admin')

@section('content')

<div class="container">
    <div class="panel panel-default">

        <div class="panel-heading">
            <h4>会員詳細</h4>
        </div>

        <div class="panel-body">
            <h5>
                <font color="#003399">ユーザ情報</font>
            </h5><br>
            <p>名前：<strong>{{ $user->name }}</strong></p>
            <p>メールアドレス：<strong>{{ $user->email }}</strong></p>
            </br>
            </br>

            <h5>
                <font color="#003399">登録住所</font>
            </h5>

            @if (empty($address))
            <h6><strong>未登録</strong></h6>

            @else
            <table class=" table table-striped">

                <tr>
                    <th>氏名</th>
                    <th>郵便番号</th>
                    <th>住所</th>
                    <th>電話番号</th>
                </tr>

                @foreach ($address as $var)
                <tr>

                    <td>
                        {{ $var->name }}
                    </td>

                    <td>
                        {{ $var->postcode }}
                    </td>

                    <td>
                        {{ $var->ken_name . $var->city_name . $var->town_memo }}
                    </td>

                    <td>
                        {{ $var->phone_num }}
                    </td>

                </tr>
                @endforeach
            </table>
            @endif

            <br>
            <br>
            <a href="{{ route('admin.user_index')}}">会員一覧に戻る</a><br><br>
            <a href="{{ route('admin.items_index')}}">商品一覧に戻る</a>
        </div>
    </div>
</div>
@endsection

</html>