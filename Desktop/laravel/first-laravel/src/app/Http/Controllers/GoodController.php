<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoodController extends Controller
{
    //
    public function index($num1, $num2)
    {
        $number = [
            'num1' => $num1,
            'num2' => $num2,
        ];
        return view('good', $number);
    }
}
