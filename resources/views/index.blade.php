@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>商品一覧</h2>
                    @if ($session)
                    <p align="right">
                        <a href="{{ route('cart.index') }}">カート一覧へ</a>
                    </p>
                    @endif
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
                                <a href="{{ route('item.detail', $var->id) }}">{{$var->item_name}}</a>
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