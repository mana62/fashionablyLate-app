@extends('layouts.default')
<style>
    th {
        background-color: #289ADC;
        color: white;
        padding: 5px 40px;
    }

    td {
        padding: 25px 40px;
        background-color: #EEEEEE;
        text-align: center;
    }
</style>
@section('title', 'find.blade.php')
@section('content')
<form action="find" method="POST">
    @csrf
    <input type="text" name="input" value="{{$input}}">
    <input type="submit" value="見つける">
</form>
@if (@isset($item))
{{--Isset()=引数に指定した変数に値が設定されている、かつ、NULLではない場合にはtrue(正)の値を戻り値とし//}}
{{--それ以外はfalse(偽)の値を返す--}}
    <table>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>nationality</th>
        </tr>
        <td>{{$item->id}}</td>
        <td>{{$item->name}}</td>
        <td>{{$item->age}}</td>
        <td>{{$item->nationality}}</td>
    </table>
@endif
@endsection