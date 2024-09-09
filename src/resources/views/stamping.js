document.addEventListener("DOMContentLoaded", function () {
    const startBreakButton = document.getElementById("startBreakButton");
    const finishBreakButton = document.getElementById("finishBreakButton");
    const startButton = document.getElementById("startButton");
    const finishButton = document.getElementById("finishButton");

    // まだ終わっていない休憩があるかどうかを確認
    const breakingNow =
        window.attendanceData &&
        window.attendanceData.breakTimes.some(
            (breakTime) => breakTime.finish_break === null
        );

    if (breakingNow) {
        startBreakButton.disabled = true;
        finishBreakButton.disabled = false;
    } else {
        startBreakButton.disabled = false;
        finishBreakButton.disabled = true;
    }

    // 勤務開始ボタンが押されたとき
    startButton.addEventListener("click", function () {
        startButton.disabled = true;
        finishButton.disabled = false;
        startBreakButton.disabled = false; // 勤務開始で休憩開始も有効化
    });

    // 休憩開始ボタンが押されたとき
    startBreakButton.addEventListener("click", function () {
        startBreakButton.disabled = true;
        finishBreakButton.disabled = false; // 休憩開始で休憩終了が有効化
    });

    // 休憩終了ボタンが押されたとき
    finishBreakButton.addEventListener("click", function () {
        finishBreakButton.disabled = true;
        startBreakButton.disabled = false; // 休憩終了で再度休憩開始が有効化
    });

    // 勤務終了ボタンが押されたとき
    finishButton.addEventListener("click", function () {
        startBreakButton.disabled = true;
        finishBreakButton.disabled = true;
        finishButton.disabled = true;
        startButton.disabled = true; // 勤務終了で全て無効化
    });
});
