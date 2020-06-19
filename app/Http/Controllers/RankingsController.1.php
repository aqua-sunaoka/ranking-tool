<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Ranking;
use App\Item;
use App\Category;

class RankingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // getでrankings/にアクセスされた場合の「一覧表示処理」
    public function index()
    {

        $data = [];
        
        if (\Auth::check()) {
            // ユーザ認証されている場合

            $user = \Auth::user();          // ユーザ情報
            $rankings = Ranking::paginate(5);     // ランキングデータを取得（5件ずつ表示）

            // 一覧表示に必要なデータをセット
            $data = [
                'user' => $user,
                'rankings' => $rankings,
            ];
        }

        // welcome.blade.php に $dataを引き渡す。        
        return view('welcome', $data);

    }
    
     /**
     * Show the form for creating a new resource.
     */
    // getでrankings/createにアクセスされた場合の「新規登録画面表示処理」
    public function create()
    {
        $ranking = new Ranking;
        
        // 新規登録ページに作成するカテゴリ選択ボックスのデータ作成 
        // ランキング未登録のカテゴリを選択できるようにデータを集める
        $existid = Ranking::select('category_id')->get();     // ランキングテーブルに登録されているカテゴリIDを取得
        $categories = Category::select('code', 'name2')->whereNotIn('id', $existid)->get();     // 未登録のカテゴリデータを取得
        
        if ( $categories->count() > 0 ) {
        
            // ランキング未登録のカテゴリがある場合は新規登録ページへ
            return view('rankings.create', [
                'ranking' => $ranking,
                'categories' => $categories,
            ]);
            
        } else {
            
            // ランキング未登録のカテゴリがない場合
            // リダイレクト
            return redirect('/');
            
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    // postでrankings/にアクセスされた場合の「新規登録処理」
    public function store(Request $request)
    {
        $ranking = new Ranking;

        // 選択されたカテゴリコードをid変換＆入力されたランキング名をバリデート→セット
        $this->setRankingData($ranking, $request);
        
        // 入力された商品コードをバリデート→商品idに変換→セット
        $this->setItemId($ranking, $request);

        // ランキングテーブルに新規登録
        $ranking->save();

        // リダイレクト
        return redirect('/');

   }

    /**
     * Show the form for editing the specified resource.
     */
    // getでrankings/id/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        $ranking = Ranking::find($id);

        return view('rankings.edit', [
            'ranking' => $ranking,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $ranking = Ranking::find($id);

        // 入力された商品コードをバリデート→商品idに変換→セット
        $this->setItemId($ranking, $request);
        
        // ランキングテーブルを更新
        $ranking->save();

        // リダイレクト
        return redirect('/');

    }

    /**
     * 選択されたカテゴリコードをカテゴリidに変換し、ランキング名をバリデートしてセット
     */
    // storeで使用する関数
    private function setRankingData($ranking, $request) {
        
        // カテゴリコードをカテゴリテーブルのidに変換
        // 新規入力画面のカテゴリ選択ボックスには未登録のカテゴリしか存在しないので、必ずUNIQUEになっている
        // バリデード
        $request->validate([
            'category' => 'required',           // 選択必須項目
        ],
        [
            'required' => ':attribute は必ず選択してください。',
        ],
        [
            'category' => 'カテゴリ',
        ]);
        
        $ranking->category_id = Category::select('id')->where('code', $request->category)->first()->id;

        // ランキング名セット
        // バリデード
        $request->validate([
            'name' => 'required|max:191',           // 入力必須＆191文字を超えない
        ],
        [
            'required' => ':attribute は必須です。',
            'max' => ':attribute は191文字以内で入力してください。',
        ],
        [
            'name' => 'ランキング名',
        ]);
        
        $ranking->name = $request->name;

    }

    /**
     * 入力された商品コードをバリデートしながら商品idに変換する
     */
    // storeとupdateで使用する関数
    private function setItemId($ranking, $request) {
        
        // 1位商品コードを商品テーブルのidに変換
        $request->validate([
            'code1' => 'required|exists:items,code',            // 入力必須＆商品テーブルに存在するコード
        ],
        [
            'required' => ':attribute は必須です。',
            'exists' => ':attribute は存在しません。',
        ],
        [
            'code1' => 'ランキング1位商品コード',
        ]);

        $ranking->rank1 = Item::select('id')->where('code', $request->code1)->first()->id;

        if (empty($request->code2)) {
            $ranking->rank2 = 0;
        } else {
            // 2位データがある場合（NotNull または 空文字列ではない場合）
            // バリデード
            $request->validate([
                'code2' => 'exists:items,code',                     // 商品テーブルに存在するコード
            ],
            [
                'exists' => ':attribute は存在しません。',
            ],
            [
                'code2' => 'ランキング2位商品コード',
            ]);
            
            $ranking->rank2 = Item::select('id')->where('code', $request->code2)->first()->id;
        }

        if (empty($request->code3)) {
            $ranking->rank3 = 0;
        } else {
            // 3位データがある場合（NotNull または 空文字列ではない場合）
            // バリデード
            $request->validate([
                'code3' => 'exists:items,code',                     // 商品テーブルに存在するコード
            ],
            [
                'exists' => ':attribute は存在しません。',
            ],
            [
                'code3' => 'ランキング3位商品コード',
            ]);

            $ranking->rank3 = Item::select('id')->where('code', $request->code3)->first()->id;
        }

        if (empty($request->code4)) {
            $ranking->rank4 = 0;
        } else {
            // 4位データがある場合（NotNull または 空文字列ではない場合）
            // バリデード
            $request->validate([
                'code4' => 'exists:items,code',                     // 商品テーブルに存在するコード
            ],
            [
                'exists' => ':attribute は存在しません。',
            ],
            [
                'code4' => 'ランキング4位商品コード',
            ]);
            
            $ranking->rank4 = Item::select('id')->where('code', $request->code4)->first()->id;
        }
        
        if (empty($request->code5)) {
            $ranking->rank5 = 0;
        } else {
            // 5位データがある場合（NotNull または 空文字列ではない場合）
            // バリデード
            $request->validate([
                'code5' => 'exists:items,code',                     // 商品テーブルに存在するコード
            ],
            [
                'exists' => ':attribute は存在しません。',
            ],
            [
                'code5' => 'ランキング5位商品コード',
            ]);

            $ranking->rank5 = Item::select('id')->where('code', $request->code5)->first()->id;
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    // deleteでranking/idにアクセスされた場合の「削除処理」
    public function destroy($id)
    {
        $ranking = Ranking::find($id);

        // ランキングテーブルから更新
        $ranking->delete();

        // リダイレクト
        return redirect('/');
    }
}
