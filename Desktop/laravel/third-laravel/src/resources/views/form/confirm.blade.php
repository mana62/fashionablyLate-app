@extends('layouts.form')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css')}}">
@endsection

@section('content')

<div class="form__confirm">
    <div class="form__confirm-ttl">お問い合わせ内容確認
    </div>
</div>

<form class="form__content-item" action="/thanks" method="post">
    @csrf

    <table class="form-confirm">
        <tr class="item-form">
            <th class="form__item">お名前</th>
            <td class="form__item-input_content">
                <input class="form-item-input" type="text" name="name" value="{{ $contact['name']  }}" readonly />
            </td>
        </tr>

        <tr class="item-form">
            <th class="form__item">メールアドレス</th>
            <td class="form__item-input_content">
                <input class="form-item-input" type="email" name="email" value="{{ $contact['email']}}" readonly />
            </td>
        </tr>

        <tr class="item-form">
            <th class="form__item">電話番号</th>
            <td class="form__item-input_content">
                <input class="form-item-input" type="tell" name="tell" value="{{ $contact['tell']}}" readonly />
            </td>
        </tr>

        <tr class="item-form">
            <th class="form__item">お問い合わせ内容</th>
            <td class="form__item-input_content">
                <input class="form-item-input" name="content" value="{{ $contact['content']}}" readonly></input>
            </td>
        </tr>

    </table>


    <div class="form__button">
        <button class="form__button-submit" type="submit">送信</button>
    </div>
</form>

@endsection