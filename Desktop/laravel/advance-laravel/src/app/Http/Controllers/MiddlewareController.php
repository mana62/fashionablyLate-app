<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MiddlewareController extends Controller
{
    public function index()
    {
        $item = [
            'content' => '自由に入力してください',
        ];
        return view('middleware', $item);
    }
    public function post(Request $request)
    {
        $content = $request->content;
        $item = [
            'content' => $content . 'と入力しました',
        ];
        return view('middleware', $item);
    }
}
