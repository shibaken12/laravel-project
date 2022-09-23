@extends('layouts.app_admin')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>会員一覧</h4>
                </div>

                <div class="panel-body">

                    <table class="table table-striped">

                        <tr>
                            <th>id</th>
                            <th>名前</th>
                        </tr>

                        @foreach ($user as $var)
                        <tr>

                            <td>
                                {{$var->id}}
                            </td>

                            <td>
                                <a href="{{ route('admin.user_detail', $var->id) }}">{{ $var->name }}</a>
                            </td>

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