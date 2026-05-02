@extends('layouts.app' , ['nav' => false])

@section('css')
    <link rel="stylesheet" href="css/login.css">
@endsection

@section('main')
@if(session('success'))
    <div class="flash-message success">
        {{session('success')}}
    </div>
@endif
<h1 class="login-ttl">ログイン</h1>
<div class="login">
    <form action="" method="post">
        @csrf
        <div class="login-form__box">
            <p class="login-form__ttl">メールアドレス</p>
            <input class="login-form__input" type="email" name="email" value="{{old('email')}}">
            <div class="error-box">
                @error('email')
                    <span class="error-message">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="login-form__box">
            <p class="login-form__ttl">パスワード</p>
            <input class="login-form__input" type="password" name="password">
            <div class="error-box">
                @error('password')
                    <span class="error-message">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="login-form__submit-box">
            <button class="login-form__button">ログイン</button>
        </div>
    </form>
    <div class="register-link__box">
        <a href="/register" class="register-link">会員登録はこちら</a>
    </div>
</div>
@endsection