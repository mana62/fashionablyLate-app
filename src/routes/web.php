<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\StampingController;
use App\Http\Controllers\AttendanceSheetController;

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

// Breezeが提供するルート
Route::get('/', function () {
    return view('welcome');
});

//認証が必要なルート
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


// 打刻機能
    Route::get('/', [StampingController::class, 'index'])->name('stamping');
    Route::post('/', [StampingController::class, 'store'])->name('stamping.store');


// 勤怠管理
Route::get('/attendance', [AttendanceSheetController::class, 'index'])->name('attendance-sheet');
});

// 日時表示
Route::get('/date/{date}', [AttendanceSheetController::class, 'show'])->name('date.show');

//合計時間
Route::get('/attendance/{id}', [AttendanceSheetController::class, 'total'])->name('attendance.total');

//ログアウト
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

require __DIR__.'/auth.php';
