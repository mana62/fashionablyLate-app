@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/attendance-sheet.css') }}">
@endsection

@section('nav')
    <ul class="header-nav-list">
        <li class="header-nav-item"><a href="{{ route('stamping') }}">ホーム</a></li>
        <li class="header-nav-item"><a href="{{ route('attendance-sheet') }}">日付一覧</a></li>
        <li class="header-nav-item"><a href="{{ route('users-index') }}">メンバー一覧</a></li>
        @if(Auth::check())
        <li class="header-nav-item"><a href="{{ route('users-attendance', ['user' => Auth::user()->id]) }}">メンバー毎の勤務一覧</a></li>
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
    @php
        use Carbon\Carbon;
        $showDays = 365;
        $currentDate = isset($date) ? Carbon::parse($date) : Carbon::now('Asia/Tokyo');
        //$dateに変数があるか確認、文字列を日時や時刻に変換、今の時間を取得

        $startDate = $currentDate->copy()->subDays(floor($showDays / 2)); //subDays = 日付オブジェクトから指定した日数を引く
        //今の日時をコピー、$showDaysを2で割り、floorで小数点を切り捨てる、subDays(...)で最後に、取得した整数の日数を現在の日付から引く($showDaysの半分の日数を減少させる)
    @endphp

    <div class="date">
        <a class="date-search__a"
            href="{{ route('date.show', ['date' => $currentDate->copy()->subDay()->format('Y-m-d')]) }}">〈</a>
        <div class="date-search">{{ $currentDate->format('Y-m-d') }}</div>
        <a class="date-search__a"
            href="{{ route('date.show', ['date' => $currentDate->copy()->addDay()->format('Y-m-d')]) }}">〉</a>
    </div>

    <div class="content">
        <table class="content-table">
            <tr class="content-table__ttl">
                <th class="content-table__name">名前</th>
                <th class="content-table__name">勤務開始</th>
                <th class="content-table__name">勤務終了</th>
                <th class="content-table__name">休憩時間</th>
                <th class="content-table__name">勤務時間</th>
            </tr>

            @foreach ($users as $user)
                @foreach ($user->attendanceSheets as $attendance)
                    @php
                        //休憩時間の合計計算
                        $totalBreakTime = $attendance->breakTimes->reduce(function ($carry, $break) {
                            //reduce= 複数の要素を1つの値にまとめ、$carry = 前回の結果 {1つ目($carry)は前回の結果、2つ目(break)現在の要素}
                            $startBreak = Carbon::parse($break->start_break);
                            $finishBreak = Carbon::parse($break->finish_break);
                            return $carry + $finishBreak->diffInMinutes($startBreak); //休憩開始と終了の時間差分を分単位で取得(diffInMinutes)
                        }, 0);

                        //勤務時間の合計計算
                        $startTime = Carbon::parse($attendance->start_time);
                        $finishTime = Carbon::parse($attendance->finish_time);
                        $totalWorkTime = $finishTime->diffInMinutes($startTime) - $totalBreakTime; // 勤務時間 - 休憩時間
                    @endphp

                    <tr class="content-table__items">
                        {{-- 名前 --}}
                        <td class="content-table__item">{{ $user->name }}</td>
                        {{-- 勤務開始 --}}
                        <td class="content-table__item">{{ $startTime->format('H:i:s') }}</td>
                        {{-- 勤務終了 --}}
                        <td class="content-table__item">{{ $finishTime->format('H:i:s') }}</td>
                        {{-- 休憩時間 --}}
                        <td class="content-table__item">
                            {{ floor($totalBreakTime / 60) }}:{{ str_pad($totalBreakTime % 60, 2, '0', STR_PAD_LEFT) }}
                            {{-- 小数点を切り捨てて60割るtotalBreakTime --}}{{-- str_pad = 文字列の長さを指定の長さになるように、前または後ろに指定した文字を追加する --}}

                            {{-- $totalBreakTimeを60で割った余りを計算
                            str_pad(..., 2, '0', STR_PAD_LEFT)
                            str_pad関数を使って、上記で得た値を2桁の文字列に整形(例：5分だったら05に変換)
                            '2'最終的な文字列の長さは2桁にする
                            '0'不足する桁数を0で埋める
                            'STR_PAD_LEFT'左側に'0'を追加して、全体の長さが2桁になるようにする --}}
                        </td>
                        {{-- 勤務時間 --}}
                        {{-- 勤務時間 --}}
                        <td class="content-table__item">
                            {{ floor($totalWorkTime / 60) }}:{{ str_pad($totalWorkTime % 60, 2, '0', STR_PAD_LEFT) }}
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </table>

        <div class="pagination">
            {{ $users->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection