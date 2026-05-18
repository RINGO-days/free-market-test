@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/address.css') }}">
@endsection

@section('main')
<h1 class="address-ttl">住所の設定</h1>
<form action="/purchase/sessionAddress/{{$product->id}}" enctype="multipart/form-data" method="post">
    @csrf
    <div class="address">
        <div class="address-form__box">
            <p class="address-form__ttl">郵便番号</p>
            <div class="post-code__box__inner">
                <input class="address-form__input" id="input-post_code" type="text" name="post_code" value="{{old('post_code',session('post_code',auth()->user()->post_code))}}">
                <button class="address-search_button" formaction="/addressSearch">住所を検索</button>
                <!--JavaScriptを用いた住所検索、有効にする場合は上記のボタンタグをコメントアウトする-->
                <!-- <button class="address-search_button" id="button" type="button">住所を検索</button> -->
            </div>
            <div class="error-box">
                @error('post_code')
                    {{$message}}
                @enderror
            </div>
        </div>
        <div class="address-form__box">
            <p class="address__ttl">住所</p>
            <input class="address-form__input" id="address" type="text" name="address" value="{{old('address',session('address',auth()->user()->address))}}">
            <div class="error-box">
                @error('address')
                    {{$message}}
                @enderror
            </div>
        </div>
        <div class="address-form__box">
            <p class="address-form__ttl">建物名</p>
            <input class="address-form__input" type="text" name="building" value="{{old('building',session('building',auth()->user()->building))}}">
        </div>
        <div class="address-form__submit-box">
            <button class="address-form__button">更新する</button>
        </div>
    </div>
</form>
<script src="{{asset('js/addressSearch.js')}}" defer></script>
@endsection