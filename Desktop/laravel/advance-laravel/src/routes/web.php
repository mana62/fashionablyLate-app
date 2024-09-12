<?php

use App\Http\Controllers\AuthorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MiddlewareController;
use App\Http\Controllers\SessionController;
use App\Models\Person;
//personモデルを使用する為に定義
use App\Models\Product;
use App\Http\Controllers\PenController;

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

//Route::get('/', function () {
//return view('welcome');
//});
Route::get('/', [AuthorController::class, 'index']);
Route::get('/add', [AuthorController::class, 'add']);
Route::post('/add', [AuthorController::class, 'create']);
Route::get('/edit', [AuthorController::class, 'edit']);
Route::post('/edit', [AuthorController::class, 'update']);
Route::get('/delete', [AuthorController::class, 'delete']);
Route::post('/delete', [AuthorController::class, 'remove']);
Route::get('/find', [AuthorController::class, 'find']);
Route::post('/find', [AuthorController::class, 'search']);
Route::get('/author/{author}', [AuthorController::class, 'bind']);
Route::get('/verror', [AuthorController::class, 'verror']);

//ルートグループ,共通化するとパスの記述部分が短くする、全てbookディレクトリ以下にあるため
Route::prefix('book')->group(function () {
    Route::get('/', [BookController::class, 'index']);
    Route::get('/add', [BookController::class, 'add']);
    Route::post('/add', [BookController::class, 'create']);
});

Route::get('/relation', [AuthorController::class, 'relate']);

Route::get('/middleware', [MiddlewareController::class, 'index']);
Route::post('/middleware', [MiddlewareController::class, 'post']);

Route::get('/session', [SessionController::class, 'getSes']);
Route::post('/session', [SessionController::class, 'postSes']);


Route::get('/softdelete', function () {
    Person::find(1)->delete();
});

Route::get('softdelete/get', function () {
    $person = Person::onlyTrashed()->get();
    dd($person);
});

Route::get('softdelete/store', function () {
    $result = Person::onlyTrashed()->restore();
    echo $result;
});

Route::get('softdelete/absolute', function () {
    $result = Person::onlyTrashed()->forceDelete();
    echo $result;
});

Route::get('uuid', function () {
    $products = Product::all();
    //Productテーブルの全てのレコードを取得して$productsへ格納
    foreach ($products as $product) {
        //foreachで１つずつ取り出していく
        echo $product . '<br>';
    }

    Route::group(['prefix' => 'pen'], function () {
        Route::get('fill', [PenController::class, 'fillPen']);
        Route::get('create', [PenController::class, 'createPen']);
        Route::get('insert', [PenController::class, 'insertPen']);
    });
});