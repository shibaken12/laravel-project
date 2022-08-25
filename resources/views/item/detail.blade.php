
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>商品詳細画面</title>
</head>

<body>

<table border="2" style="border-collapse: collapse" bordercolor="black">

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

</body>
</html>