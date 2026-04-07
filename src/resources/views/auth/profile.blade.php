@extends('layouts.app' , ['nav' => false])

@section('css')
    <link rel="stylesheet" href="css/profile.css">
@endsection

@section('main')
<h1 class="profile-ttl">プロフィール設定</h1>
<form action="" enctype="multipart/form-data">
    <div class="profile-img__box">
        <input type="file" name="profile-img">
    </div>
</form>
<div class="profile">
    <form action="" method="post">
        @csrf
        <div class="profile-form__box">
            <p class="profile-form__ttl">ユーザー名</p>
            <input class="profile-form__input" type="text" name="name" value="{{old('name')}}">
            <div class="error-box">
                @error('name')
                    {{$message}}
                @enderror
            </div>
        </div>
        <div class="profile-form__box">
            <p class="profile-form__ttl">郵便番号</p>
            <input class="profile-form__input" type="text" name="post-code" value="{{old('email')}}">
            <div class="error-box">
                @error('post-code')
                    {{$message}}
                @enderror
            </div>
        </div>
        <div class="profile-form__box">
            <p class="profile__ttl">住所</p>
            <input class="profile-form__input" type="text" name="address">
            <div class="error-box">
                @error('address')
                    {{$message}}
                @enderror
            </div>
        </div>
        <div class="profile-form__box">
            <p class="profile-form__ttl">建物名</p>
            <input class="profile-form__input" type="text" name="building">
        </div>
        <div class="profile-form__submit-box">
            <button class="profile-form__button">更新する</button>
        </div>
    </form>
</div>
@endsection