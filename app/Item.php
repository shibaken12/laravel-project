<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //ホワイトリストとブラックリストは片方しか使えない
    //ホワイトリストの場合
    protected $fillable = [
        'item_name', 'explanation', 'price', 'stock'
    ];

    //ブラックリストで設定する場合
    // protected $guarded = ['id'];
}
