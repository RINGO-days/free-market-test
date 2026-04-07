@extends('layouts.app' , ['nav' => false])

@section('css')
    <link rel="stylesheet" href="css/login.css">
@endsection

@section('main')
<h1 class="login-ttl">ログイン</h1>
<div class="login">
    <form action="" method="post">
        @csrf
        <div class="login-form__box">
            <p class="login-form__ttl">メールアドレス</p>
            <input class="login-form__input" type="email" name="email" value="{{old('email')}}">
            <div class="error-box">
                @error('email')
                    {{$message}}
                @enderror
            </div>
        </div>
        <div class="login-form__box">
            <p class="login-form__ttl">パスワード</p>
            <input class="login-form__input" type="password" name="password">
            <div class="error-box">
                @error('password')
                    {{$message}}
                @enderror
            </div>
        </div>
        <div class="login-form__submit-box">
            <button class="login-form__button">ログイン</button>
        </div>
    </form>
</div>
@endsection