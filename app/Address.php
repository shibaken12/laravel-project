<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;
    //ブラックリストで設定する場合
    protected $guarded = ['id'];

    protected $table = 'addresses';
}
