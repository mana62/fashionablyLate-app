<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FirstMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

     //handleメソッド内に処理を記述することで、ミドルウェアを実行することができる
    public function handle(Request $request, Closure $next)
    {
        $input = "ミドルウェアが書き換えています";
        $request->merge(['content'=>$input]);
        //mergeメソッドは、フォームの送信などで送られる値に新たな値を追加するメソッド
        return $next($request);
    }
}

//第一引数 $request、クライアントからのリクエストの内容が格納されている
//第二引数 $next、Closureというクラスからインスタンス化されている関数
//戻り値 $next($request)、実行されると、次の処理が行われる