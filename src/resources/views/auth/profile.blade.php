@extends('layouts.app' , ['nav' => false])

@section('css')
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
@endsection

@section('main')
<h1 class="profile-ttl">プロフィール設定</h1>
<form action="/profile/create" enctype="multipart/form-data" method="post">
    @csrf
    <div class="profile-img__box">
        <label class="image__input-button" for="image__input">
            <span class="image__input-button__text">画像を選択</span>
            <input class="image__input" id="image__input" type="file" name="image">
        </label>
        <div class="error-box">
                @error('image')
                    <span class="error-message">{{$message}}</span>
                @enderror
            </div>
    </div>
    <div class="profile">
        <div class="profile-form__box">
            <p class="profile-form__ttl">ユーザー名</p>
            <input class="profile-form__input" type="text" name="name" value="{{old('name')}}">
            <div class="error-box">
                @error('name')
                    <span class="error-message">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="profile-form__box">
            <p class="profile-form__ttl">郵便番号</p>
            <input class="profile-form__input" type="text" name="post_code" value="{{old('post_code')}}">
            <div class="error-box">
                @error('post_code')
                    <span class="error-message">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="profile-form__box">
            <p class="profile__ttl">住所</p>
            <input class="profile-form__input" type="text" name="address" value="{{old('address')}}">
            <div class="error-box">
                @error('address')
                    <span class="error-message">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="profile-form__box">
            <p class="profile-form__ttl">建物名</p>
            <input class="profile-form__input" type="text" name="building" value="{{old('building')}}">
        </div>
        <div class="profile-form__submit-box">
            <button class="profile-form__button">更新する</button>
        </div>
    </div>
</form>
@endsection