@extends('layouts.default')
<style>
    th {
        background-color: #289ADC;
        color: white;
        padding: 5px 40px;
    }

    tr:nth-child(odd) td {
        background-color: #FFFFFF;
    }

    td {
        padding: 25px 40px;
        background-color: #EEEEEE;
        text-align: center;
    }
</style>
@section('title', 'book.add.blade.php')

@section('content')

@if (count($errors) > 0)
{{--エラーチェック、エラーがあったら以下実行--}}
    <ul>
        @foreach ($errors->all() as $error)
        {{--@foreachはすべてのエラーメッセージをループ、$errors->all()はエラーメッセージの配列を返す--}}
            <li>
                {{$error}}
                {{--エラーメッセージの表示--}}
            </li>
        @endforeach
    </ul>
@endif
<form action="/book/add" method="post">
    <table>
        @csrf
        {{--安全な対策--}}
        <tr>
            <th>author_id:</th>
            <td><input type="id" name="author_id"></td>
        </tr>
        <tr>
            <th>title:</th>
            <td><input type="text" name="title"></td>
        </tr>
    </table>
    <button>送信</button>
</form>
@endsection