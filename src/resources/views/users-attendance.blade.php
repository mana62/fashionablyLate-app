@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/users-attendance.css') }}">
@endsection

@section('nav')
    <ul class="header-nav-list">
        <li class="header-nav-item"><a href="{{ route('stamping') }}">ホーム</a></li>
        <li class="header-nav-item"><a href="{{ route('attendance-sheet') }}">日付一覧</a></li>
        <li class="header-nav-item"><a href="{{ route('users-index') }}">メンバー一覧</a></li>
        @if (Auth::check())
            <li class="header-nav-item"><a
                    href="{{ route('users-attendance', ['user' => Auth::user()->id]) }}">メンバー毎の勤務一覧</a></li>
        @endif
        <li class="header-nav-item">
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                {{ __('ログアウト') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
@endsection

@section('content')
    <div class="ttl">
        <h2 class="ttl-users">
            メンバー毎の勤務一覧表
        </h2>
        <h3 class="ttl-user">
            {{ $user->name }}さんの勤務データ
        </h3>

        <div class="search-users">
            <form class="search-users__form" action="{{ route('attendance-index.search') }}" method="post">
                @csrf
                <input class="search-users__input" type="text" name="input" placeholder="お名前またはIDを入力してください"
                    value="{{ $input ?? '' }}">
                <button class="search-users__submit" type="submit">検索</button>
            </form>
        </div>
    </div>

    <div class="table">
        <table class="table-user">
            <tr class="table-user__row">
                <th class="table-user__ttl">日付</th>
                <th class="table-user__ttl">勤務開始</th>
                <th class="table-user__ttl">勤務終了</th>
                <th class="table-user__ttl">休憩時間</th>
                <th class="table-user__ttl">勤務時間</th>
            </tr>

            @php
                use Carbon\Carbon;
            @endphp

            @foreach ($user->attendanceSheets as $attendanceSheet)
                @php
                    $startTime = Carbon::parse($attendanceSheet->start_time ?? '');
                    $finishTime = Carbon::parse($attendanceSheet->finish_time ?? '');
                    $totalJobTime = $finishTime->diffInMinutes($startTime);

                    $totalBreakTime = $attendanceSheet->breakTimes->reduce(function ($carry, $breakTime) {
                        //$carryの役割は今までの休憩時間を足していく役割、reduceは沢山の数字などを一つにまとめる役割
                        $startBreak = Carbon::parse($breakTime->start_break ?? '');
                        $finishBreak = Carbon::parse($breakTime->finish_break ?? '');
                        return $carry + $finishBreak->diffInMinutes($startBreak);
                    }, 0);

                    $autualJobTime = $totalJobTime - $totalBreakTime;
                @endphp

                <tr class="table-user">
                    <td class="table-user__detail">{{ Carbon::parse($attendanceSheet->created_at ?? '')->format('Y-m-d') }}
                    </td>
                    <td class="table-user__detail">{{ $startTime->format('H:i') }}</td>
                    <td class="table-user__detail">{{ $finishTime->format('H:i') }}</td>
                    <td class="table-user__detail">{{ floor($totalBreakTime / 60) }}時間{{ $totalBreakTime % 60 }}分</td>
                    <td class="table-user__detail">
                        {{ floor($actualWorkTime ?? 0 / 60) }}時間{{ ($actualWorkTime ?? 0) % 60 }}分</td>
                </tr>
            @endforeach
        </table>
    </div>

<div class="pagination">
        {{ $users->links('vendor.pagination.custom') }}
    </div>
@endsection