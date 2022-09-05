<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//現在認証されているユーザを取得するためのファサード
use Illuminate\Support\Facades\Auth;
//transactionを使うためのファサード
use Illuminate\Support\Facades\DB;
use App\User;
use App\Item;

class Cart extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id', 'item_id', 'quantity'];

    //このモデルが参照したいテーブルを指定
    protected $table = 'carts';

    //usersテーブルとのリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //itemsテーブルとのリレーション
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    //データベースへのインサート文定義
    public function insert($item_id, $add_quantity)
    {
        $item = (new item)->findOrFail($item_id);
        $quantity = $item->stock;

        if ($quantity == 0) {
            return false;
        }
        //user_idとitem_idがDBに存在しなければquantityに０を入れる
        //存在していれば、存在しているレコードのquantityを更新する
        $cart = $this->firstOrCreate(['user_id' => Auth::id(), 'item_id' => $item_id], ['quantity' => 0]);
        //トランザクション開始
        DB::beginTransaction();
        try {
            //カートの中の購入数をプラス１
            $cart->increment('quantity', $add_quantity);
            //カートに追加した分をitemsテーブルのstockから在庫を減らしておく
            $item->decrement('stock', $add_quantity);
            //データ操作を確定させる
            DB::commit();
            return true;
        } catch (\Exception $e) {
            $e->getMessage();
            //データ操作を巻き戻す
            DB::rollback();
            return false;
        }
    }

    public function remove($cart_id)
    {
        $cart = $this->findOrFail($cart_id);

        if ($cart->user_id == Auth::id()) {
            DB::beginTransaction();
            try {
                $item_id = $cart->item_id;
                $quantity = $cart->quantity;

                //取得したカートのレコードを削除
                $cart->delete();

                //cartの中のitem情報を取得
                $item = (new Item)->find($item_id);

                //削除したcartの購入数分をitemsテーブルの在庫数を増やす
                $item->increment('stock', $quantity);

                DB::commit();
                return true;
            } catch (\Exception $e) {
                $e->getMessage();
                DB::rollback();
            }
        }
        return false;
    }

    //１商品当たりの小計を出力する関数（Controllerのtotalで呼び出し）
    public function subtotal()
    {
        //$this->item->priceではなく、item['price']にしないとエラーが出るよ
        // $result = $this->item['price'] * $this->quantity;
        $result = $this->item->price * $this->quantity;
        return $result;
    }
}
