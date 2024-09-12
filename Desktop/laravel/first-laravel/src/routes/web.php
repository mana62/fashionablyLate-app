<?php

use App\Http\Controllers\GoodController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\HelloController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/test/{text?}', [TestController::class, 'index']);
Route::get('/test', [TestController::class, 'index']);
Route::get('/hello', [HelloController::class, 'index']);
Route::get('/good/{num1?}/{num2?}',  [GoodController::class, 'index']);

Route::get('/test/{room}/{id}', function ($room, $id){
    return "{$room}が200で{$id}は3です";
});

Route::get('/test/{greeting?}', function ($greeting = 'Goodmorning'){
    return "{$greeting}='おはよう";
});

//Route::get('/',  [TestController::class, 'index']);
//Route::get('/hello', [TestController::class, 'index']);

Route::get('/test/{room}/{id}', function($room, $id)
{
    return "{room}が200で{id}は3です";
});

Route::get('/test/{$greeting?}', function($greeting = 'Goodmorning')
{
return $greetin . "おはようございます";
});

