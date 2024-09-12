<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AttendanceSheet;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AttendanceSheetController extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    public function index()
    {
        $users = User::with([
            'attendanceSheets' => function ($query) {
                $query->orderBy('start_time', 'desc'); // 出勤情報を開始時間の降順でソート
            }
        ])->paginate(5);

        return view('attendance-sheet', compact('users'));
    }

    //日付
    public function show($date)
    {
        $date = Carbon::parse($date)->setTimezone('Asia/Tokyo'); //文字列から日付や時刻(tokyoの時間)を扱える形式に変換して$dataに格納

        $users = User::whereHas('attendanceSheets', function ($query) use ($date) { //userモデルから関連するデータを探す、useで外部変数を使用
            $query->whereDate('start_time', $date->format('Y-m-d'));
        })
            ->with([ //N+1問題の為withを使用
                'attendanceSheets' => function ($query) use ($date) {
                    $query->whereDate('start_time', $date->format('Y-m-d'))
                        ->orderBy('start_time', 'desc');
                }
            ])
            ->paginate(5);

        return view('attendance-sheet', compact('users', 'date'));
    }

    public function total($id)
{
    $attendance = AttendanceSheet::with('breakTimes')->find($id); //リレーションとIDで勤務データを取得

    if ($attendance && $attendance->start_time && $attendance->finish_time) { //勤務開始・終了が存在する場合
        //勤務時間の計算
        $startTime = Carbon::parse($attendance->start_time);
        $finishTime = Carbon::parse($attendance->finish_time);
        $totalWorkMinutes = $finishTime->diffInMinutes($startTime);

        //休憩時間の合計の計算
        $totalBreakMinutes = $attendance->breakTimes->reduce(function ($carry, $breakTime) {
            //休憩終了時間が存在するかチェック
            if ($breakTime->finish_break) {
                $startBreak = Carbon::parse($breakTime->start_break);
                $finishBreak = Carbon::parse($breakTime->finish_break);
                return $carry + $finishBreak->diffInMinutes($startBreak);
            }
            return $carry; //休憩終了時間がない場合、合計に追加しない
        }, 0);

        //実働時間 = 勤務時間 - 休憩時間
        $actualWorkMinutes = $totalWorkMinutes - $totalBreakMinutes;

        return view('attendance.total', [
            'attendance' => $attendance,
            'totalWorkHours' => floor($totalWorkMinutes / 60),  //勤務時間（時間）
            'totalWorkMinutes' => $totalWorkMinutes % 60,        //勤務時間（分）
            'totalBreakHours' => floor($totalBreakMinutes / 60), //休憩時間（時間）
            'totalBreakMinutes' => $totalBreakMinutes % 60,      //休憩時間（分）
            'actualWorkHours' => floor($actualWorkMinutes / 60), //実働時間（時間）
            'actualWorkMinutes' => $actualWorkMinutes % 60,      //実働時間（分）
        ]);
    }

    //勤務データが存在しない場合
    return redirect()->back();
}

}