<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    /**
     * ランキングに関連するカテゴリ情報を取得
     */
    public function category()
    {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }

    /**
     * ランキングに関連する1位商品情報を取得
     */
    public function item1()
    {
        return $this->hasOne('App\Item', 'id', 'rank1');
    }

    /**
     * ランキングに関連する2位商品情報を取得
     */
    public function item2()
    {
        return $this->hasOne('App\Item', 'id', 'rank2');
    }

    /**
     * ランキングに関連する3位商品情報を取得
     */
    public function item3()
    {
        return $this->hasOne('App\Item', 'id', 'rank3');
    }

    /**
     * ランキングに関連する4位商品情報を取得
     */
    public function item4()
    {
        return $this->hasOne('App\Item', 'id', 'rank4');
    }

    /**
     * ランキングに関連する5位商品情報を取得
     */
    public function item5()
    {
        return $this->hasOne('App\Item', 'id', 'rank5');
    }
    
}
