<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\AttendanceSheet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class StampingController extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    //ユーザーの最新の打刻データを取得
    public function index()
    {
        //ユーザーの最新の勤怠データを取得
        $attendance = AttendanceSheet::where('user_id', Auth::id())->latest()->first();

        return view('stamping', compact('attendance'));
    }

    public function store(Request $request)
    {
        // 最新の勤怠データを取得または新規作成
        $attendance = AttendanceSheet::firstOrNew(['user_id' => Auth::id()]);
        $message = '';

        // アクションの処理
        if ($request->has('start_time')) {
            $attendance->start_time = Carbon::now();
            $message = '勤務を開始しました';
        } elseif ($request->has('finish_time')) {
            $attendance->finish_time = Carbon::now();
            $message = '勤務を終了しました';
        } elseif ($request->has('start_break')) {
            $attendance->breakTimes()->create(['start_break' => Carbon::now()]);
            $message = '休憩を開始しました';
        } elseif ($request->has('finish_break')) {
            $lastBreak = $attendance->breakTimes()->whereNull('finish_break')->latest()->first();
            if ($lastBreak) {
                $lastBreak->update(['finish_break' => Carbon::now()]);
                $message = '休憩を終了しました';
            }
        }

        // 勤怠データを保存
        $attendance->save();

        return redirect()->route('stamping')->with('message', $message);
    }
}

