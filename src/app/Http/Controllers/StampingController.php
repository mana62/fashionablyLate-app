<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AttendanceSheet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class StampingController extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    public function index()
    {
        //ユーザーの最新の勤怠データを取得
        $attendance = AttendanceSheet::where('user_id', Auth::id())->latest()->first();

        if ($attendance && !Carbon::parse($attendance->start_time)->isToday()) {
            $attendance = null;
        }
        return view('stamping', compact('attendance'));
    }

    public function store(Request $request)
    {
        //今日の日付
        $today = Carbon::today();

        //当日の勤怠データを取得（当日が存在しなければ新しく作成する）
        $attendance = AttendanceSheet::where('user_id', Auth::id())
            ->whereDate('start_time', $today)  //勤務開始が当日の日付かを確認
            ->firstOrNew(['user_id' => Auth::id()]);

        $message = '';

        //勤務開始
        if ($request->has('start_time')) {
            // 勤務開始時間を現在時刻で設定
            if (!$attendance->exists) {
                $attendance->start_time = Carbon::now();
                $message = '勤務を開始しました';
            }
        }
        //勤務終了
        elseif ($request->has('finish_time')) {
            if ($attendance->start_time && !$attendance->finish_time) {
                $attendance->finish_time = Carbon::now();
                $message = '勤務を終了しました';
            }
        }
        //休憩開始
        elseif ($request->has('start_break')) {
            if ($attendance->start_time && !$attendance->finish_time) {
                $attendance->breakTimes()->create(['start_break' => Carbon::now()]);
                $message = '休憩を開始しました';
            }
        }
        //休憩終了
        elseif ($request->has('finish_break')) {
            $lastBreak = $attendance->breakTimes()->whereNull('finish_break')->latest()->first();
            if ($lastBreak) {
                $lastBreak->update(['finish_break' => Carbon::now()]);
                $message = '休憩を終了しました';
            }
        }
        //勤怠データを保存
        $attendance->save();

        return redirect()->route('stamping')->with('message', $message);
    }
}

