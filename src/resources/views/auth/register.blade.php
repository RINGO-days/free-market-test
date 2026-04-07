@extends('layouts.app' , ['nav' => false])

@section('css')
    <link rel="stylesheet" href="css/register.css">
@endsection

@section('main')
<h1 class="register-ttl">会員登録</h1>
<div class="register-form">
    <form action="{{ route('register') }}" method="post">
        @csrf
        <div class="register-form__box">
            <p class="register-form__ttl">ユーザー名</p>
            <input class="register-form__input" type="text" name="name" value="{{old('name')}}">
            <div class="error-box">
                @error('name')
                    {{$message}}
                @enderror
            </div>
        </div>
        <div class="register-form__box">
            <p class="register-form__ttl">メールアドレス</p>
            <input class="register-form__input" type="email" name="email" value="{{old('email')}}">
            <div class="error-box">
                @error('email')
                    {{$message}}
                @enderror
            </div>
        </div>
        <div class="register-form__box">
            <p class="register-form__ttl">パスワード</p>
            <input class="register-form__input" type="password" name="password">
            <div class="error-box">
                @error('password')
                    {{$message}}
                @enderror
            </div>
        </div>
        <div class="register-form__box">
            <p class="register-form__ttl">確認用パスワード</p>
            <input class="register-form__input" type="password" name="password_confirmation">
        </div>
        <div class="register-form__submit-box">
            <button class="register-form__button">登録する</button>
        </div>
    </form>
    <div class="login-box">
        <a class="login" href="">ログインはこちら</a>
    </div>
</div>
@endsection