<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\book;

class BookController extends Controller
{
    // データ一覧ページの表示
    public function index()
    {
        $items = Book::with('author')->get();
        //bookから全てのレコードを取得して$itemへ入れる
        //itemを配列にしてviewへ返す
        return view('book.index', ['items'=>$items]);
    }

    // データ追加用ページの表示
    //フォーム用のページに遷移するように設定
    public function add()
    {
        return view('book.add');
    }

    // 追加機能
    //送信されたデータをバリデートし、新しい書籍（Book）をデータベースに保存する
    public function create(Request $request)
    {
        $this->validate($request, Book::$rules);
        //バリデーション、フォームから送信されたデータが指定されたルールに従っているかどうかを確認する機能
        $form = $request->all();
        //全てのデータを取得し$formへ格納
        Book::create($form);
        //新しい書籍のレコードを作成
        return redirect('/book');
        //書籍が正常に作成された後、ユーザーを/bookページにリダイレクト
        //これでユーザーが書籍の一覧ページなどを見れる
    }

}
