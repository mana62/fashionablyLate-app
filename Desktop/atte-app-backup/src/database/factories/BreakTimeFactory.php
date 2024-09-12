<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\AttendanceSheet;
use Carbon\Carbon;

class BreakTimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // ランダムに選んだ出勤データを取得
        $attendanceSheet = AttendanceSheet::inRandomOrder()->first();

        // 勤務終了時間を取得
        $finishTime = Carbon::parse($attendanceSheet->finish_time);

        // 10時から16時の間でランダムな休憩開始時間を設定
        $startBreak = Carbon::createFromTime(rand(10, 16), rand(0, 59));

        // 勤務終了時間を超えないように休憩終了時間を設定
        if ($startBreak->greaterThanOrEqualTo($finishTime)) {
            $startBreak = $finishTime->copy()->subMinutes(rand(30, 60));
        }

        // 30分〜60分のランダムな休憩終了時間を設定
        $finishBreak = $startBreak->copy()->addMinutes(rand(30, 60));

        // 休憩終了時間が勤務終了時間を超えないように調整
        if ($finishBreak->greaterThan($finishTime)) {
            $finishBreak = $finishTime->copy();
        }

        return [
            'attendance_sheet_id' => $attendanceSheet->id,
            'start_break' => $startBreak,
            'finish_break' => $finishBreak,
        ];
    }
}
