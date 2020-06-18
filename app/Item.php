<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * 商品情報を所有するランキングを取得
     */
    public function ranking()
    {
        return $this->belongsTo('App\Ranking');
    }
}
