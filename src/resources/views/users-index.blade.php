@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/users-index.css') }}">
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
            メンバー一覧表
        </h2>

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
        <table class="table-users">
            <tr class="table-users__row">
                <th class="table-users__ttl">ID</th>
                <th class="table-users__ttl">名前</th>
                <th class="table-users__ttl"></th>
            </tr>
            @foreach ($users as $user)
                @if ($user)
                    <!--userがnullでないことをチェック-->
                    <tr class="table-users__row">
                        <td class="table-users__contents">{{ $user->id }}</td>
                        <td class="table-users__contents">{{ $user->name }}</td>
                        <td class="table-users__contents"><a href="{{ route('users-attendance', $user->id) }}">詳細</a></td>
                    </tr>
                @endif
            @endforeach
        </table>
    </div>

    <div class="pagination">
        {{ $users->links('vendor.pagination.custom') }}
    </div>
@endsection
