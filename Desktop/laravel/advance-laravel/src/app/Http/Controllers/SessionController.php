<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function getSes(Request $request)
    {
        $data = $request->session()->get('txt');
        return view('/session', ['data' => $data]);
    }
    public function postSes(Request $request)
    {
        $txt = $request->input;
        $request->session()->put('txt', $txt);
        return redirect('/session');
    }

    //1,ビューで値を入力し送信する(post)
    //2,postSesアクションが起動し、session()->put()で値を保存
    //3,session にリダイレクト
    //4,getSesアクションが起動し、session()->get()で値を取得
}
