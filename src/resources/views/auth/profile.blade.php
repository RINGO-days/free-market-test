@extends('layouts.app' , ['nav' => false])

@section('css')
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
@endsection

@section('main')
<h1 class="profile-ttl">プロフィール設定</h1>
<form action="/profile/create" enctype="multipart/form-data" method="post">
    @csrf
    <div class="profile-img__box">
        <div class="profile-img__inner">
            <img class="profile-img" id="preview-img" src="{{ $user->image ? asset('storage/'.$user->image) : ''}}" alt="プロフィール画像" style="opacity: {{ $user->image ? 1 : 0 }}">
        </div>
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
            <input class="profile-form__input" type="text" name="name" value="{{old('name',$user->name)}}">
            <div class="error-box">
                @error('name')
                    <span class="error-message">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="profile-form__box">
            <p class="profile-form__ttl">郵便番号</p>
            <div class="post-code__box__inner">
                <input class="profile-form__input" type="text" name="post_code" value="{{old('post_code',$user->post_code)}}">
                <button class="address-search_button" formaction="/addressSearch">住所を検索</button>
            </div>
            <div class="error-box">
                @error('post_code')
                    <span class="error-message">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="profile-form__box">
            <p class="profile__ttl">住所</p>
            <input class="profile-form__input" type="text" name="address" value="{{old('address',$user->address)}}">
            <div class="error-box">
                @error('address')
                    <span class="error-message">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="profile-form__box">
            <p class="profile-form__ttl">建物名</p>
            <input class="profile-form__input" type="text" name="building" value="{{old('building',$user->building)}}">
        </div>
        <div class="profile-form__submit-box">
            <button class="profile-form__button">更新する</button>
        </div>
    </div>
</form>
<script src="{{asset('js/preview.js')}}"></script>
@endsection