<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>商品一覧</title>
</head>

<body>

<table border="2" style="border-collapse: collapse" bordercolor="black">

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

</body>
</html>