<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * カテゴリ情報を所有するランキングを取得
     */
    public function ranking()
    {
        return $this->belongsTo('App\Ranking');
    }
}
