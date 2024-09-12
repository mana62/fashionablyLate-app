document.addEventListener("DOMContentLoaded", function () {
    const attendanceData = window.attendanceData;

    const startBreakButton = document.getElementById("startBreakButton");
    const finishBreakButton = document.getElementById("finishBreakButton");
    const startButton = document.getElementById("startButton");
    const finishButton = document.getElementById("finishButton");

    //今日の日付
    const today = new Date().toISOString().split('T')[0];

    //勤怠データが今日の日付のものかを確認
    const isTodayAttendance = attendanceData && new Date(attendanceData.start_time).toISOString().split('T')[0] === today;

    //勤務中かどうかを確認
    const isWorking = isTodayAttendance && attendanceData && attendanceData.start_time && !attendanceData.finish_time;

    //休憩中かどうかを確認（まだ終了していない休憩があるか）
    const breakingNow = isWorking && attendanceData.breakTimes.some(breakTime => breakTime.finish_break === null);

    //ボタンの状態を設定
    if (isWorking) {
        startButton.disabled = true;
        finishButton.disabled = false;
        startBreakButton.disabled = breakingNow;
        finishBreakButton.disabled = !breakingNow;
    } else {
        startButton.disabled = false;
        finishButton.disabled = true;
        startBreakButton.disabled = true;
        finishBreakButton.disabled = true;
    }

    //勤務開始ボタンが押されたとき
    startButton.addEventListener("click", function () {
        startButton.disabled = true;
        finishButton.disabled = false;
        startBreakButton.disabled = false;
    });

    //休憩開始ボタンが押されたとき
    startBreakButton.addEventListener("click", function () {
        startBreakButton.disabled = true;
        finishBreakButton.disabled = false;
    });

    //休憩終了ボタンが押されたとき
    finishBreakButton.addEventListener("click", function () {
        finishBreakButton.disabled = true;
        startBreakButton.disabled = false;
    });

    //勤務終了ボタンが押されたとき
    finishButton.addEventListener("click", function () {
        startBreakButton.disabled = true;
        finishBreakButton.disabled = true;
        finishButton.disabled = true;
        startButton.disabled = true;
    });
});
