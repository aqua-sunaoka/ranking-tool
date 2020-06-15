<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Ranking;
use App\Item;
use App\Category;

class RankingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // getでrankings/にアクセスされた場合の「一覧表示処理」
    public function index()
    {

        $data = [];
        
        if (\Auth::check()) {
            // ユーザ認証されている場合

            $user = \Auth::user();          // ユーザ情報
            $rankings = Ranking::all();     // ランキングデータを取得

            // ランキング数分ループして商品情報を取得する
            foreach ($rankings as $ranking)   {
                
                $this->set_itemdata($ranking);       // このループの中身をこんな関数にすればいいはず？

            }

            // 一覧表示に必要なデータをセット
            $data = [
                'user' => $user,
                'rankings' => $rankings,
            ];
        }

        // welcome.blade.php に $dataを引き渡す。        
        return view('welcome', $data);

    }
    
    //
    // $ranking （各ランキング情報）に対応する 商品情報・カテゴリ情報をセット
    //
    public function set_itemdata($ranking)
    {
        // カテゴリデータを取得
        $category = Category::find($ranking->category_id);  // カテゴリ情報Get
        $ranking->cname1 = $category->name1;        // 大カテゴリ名
        $ranking->cname2 = $category->name2;        // 中カテゴリ名

        // 1位
        $item1 = Item::find($ranking->rank1);   // 1位商品情報Get
        $ranking->code1 = $item1->code;         // とりあえず1位商品コード
        $ranking->comment1 = $item1->comment;   // とりあえず1位商品コメント
                
        // 2位
        if ($ranking->rank2 > 0) {
            // 2位のデータがある時                    
            $item2 = Item::find($ranking->rank2);   // 2位商品情報Get
            $ranking->code2 = $item2->code;
            $ranking->comment2 = $item2->comment;
        }
        
        // 3位
        if ($ranking->rank3 > 0) {
            // 3位のデータがある時                    
            $item3 = Item::find($ranking->rank3);   // 3位商品情報Get
            $ranking->code3 = $item3->code;
            $ranking->comment3 = $item3->comment;
        }
        
        // 4位
        if ($ranking->rank4 > 0) {
            // 4位のデータがある時                    
            $item4 = Item::find($ranking->rank4);   // 4位商品情報Get
            $ranking->code4 = $item4->code;
            $ranking->comment4 = $item4->comment;
        }

        // 5位
        if ($ranking->rank5 > 0) {
            // 5位のデータがある時                    
            $item5 = Item::find($ranking->rank5);   // 5位商品情報Get
            $ranking->code5 = $item5->code;
            $ranking->comment5 = $item5->comment;
        }

        return;
    }


     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
