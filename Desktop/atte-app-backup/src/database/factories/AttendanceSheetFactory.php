<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\AttendanceSheet;
use Carbon\Carbon;

class AttendanceSheetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // 開始時間を8時または9時に設定
        $startHour = $this->faker->randomElement([8, 9]);
        $startTime = Carbon::now()->setTimezone('Asia/Tokyo')
            ->subDays($this->faker->numberBetween(0, 30))  // 過去30日間からランダム
            ->setTime($startHour, 0, 0);

        // 終了時間は8時始業なら17時、9時始業なら18時
        $finishTime = $startTime->copy()->setTime($startHour + 9, 0, 0);

        return [
            'user_id' => $this->faker->numberBetween(1, 100),
            'start_time' => $startTime,
            'finish_time' => $finishTime,
        ];
    }
}
