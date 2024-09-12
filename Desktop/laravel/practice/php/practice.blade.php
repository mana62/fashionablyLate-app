@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/practice.css') }}">
@endsection

@section('content')

@if(session('success'))
    <div class="todo__message-correct">Todoを作成しました</div>
@endif

@error('todo')
    <div class="todo__message-error">{{ $message }}</div>
@enderror


<div class="todo__content">
    <form class="todo" method="POST" action="">
        @csrf
        <div class="todo__create-content">
            <input class="todo__create-input" type="text" name="content">
        </div>
        <div class="todo__create-button">
            <button class="todo-submit" type="submit">作成</button>
        </div>
    </form>

    <div class="todo__table">
        <table class="todo-table__inner">
            <tr class="todo-table__row">
                <th class="todo-table__header">Todo</th>
            </tr>

            <tr class="todo-table__row">
                <td class="todo-table__item">
                    <form class="update-form" method="POST" action="">
                        @csrf
                        <div class="update-form__item">
                            <input class="update-form-input" type="text" name="content" value="test">
                        </div>
                        <div class="update-form__button">
                            <button class="todo__button-blue" type="text" name="content" value="test">更新</button>
                        </div>
                    </form>
                </td>
                <td class="todo-table__item">
                    <form class="delete-form" method="POST" action="">
                        @csrf
                        <div class="delete-form__button">
                            <button class="todo__button-red" type="submit">削除</button>
                        </div>
                    </form>
                </td>
            </tr>

            <tr class="todo-table__row">
                <td class="todo-table__item">
                    <form class="update-form" method="POST" action="">
                        @csrf
                        <div class="update-form__item">
                            <input class="update-form-input" type="text" name="content" value="test2">
                        </div>
                        <div class="update-form__button">
                            <button class="todo__button-blue" type="text" name="content" value="test">更新</button>
                        </div>
                    </form>
                </td>
                <td class="todo-table__item">
                    <form class="update-form" method="POST" action="">
                        @csrf
                        <div class="delete-form__button">
                            <button class="todo__button-red" type="submit">削除</button>
                        </div>
                    </form>
                </td>
            </tr>
        </table>
        @endsection