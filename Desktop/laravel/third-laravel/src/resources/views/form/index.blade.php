@extends('layouts.form')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('content')

<div class="form__heading">
    <div class="form__heading-ttl">お問い合わせ</div>
</div>

<div class="form__item">
    <form class="form__content-item" action="/confirm" method="post">
        @csrf

        <div class="item-form">
            <p class="item-form-label">お名前
                <span class="form-required">必須</span>
            </p>
            <input class="form-item-input" type="text" name="name" placeholder="山田たろう" value="{{ old('name')}}" />
        </div>


        <div class="error">
            @error('name')
            {{ $message }}
            @enderror
        </div>

        <div class="item-form">
            <p class="item-form-label">メールアドレス
                <span class="form-required">必須</span>
            </p>
            <input class="form-item-input" type="email" name="email" placeholder="test@com" value="{{ old('email')}}" />
        </div>



        <div class="error">
        @error('email')
            {{ $message }}
            @enderror
        </div>

        <div class="item-form">
            <p class="item-form-label">電話番号
                <span class="form-required">必須</span>
            </p>

            <input class="form-item-input" type="tell" name="tell" placeholder="09012345678" value="{{ old('tell')}}" />
        </div>



        <div class="error">
        @error('tell')
            {{ $message }}
            @enderror
        </div>

        <div class="item-form">
            <p class="item-form-label">お問い合わせ内容</p>
            <textarea class="form-item-textarea" name="content"  value="{{ old('content')}}" ></textarea>
        </div>

        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面へ</button>
        </div>
    </form>

</div>

@endsection