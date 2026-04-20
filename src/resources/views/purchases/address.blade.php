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
            <input class="address-form__input" type="text" name="post_code" value="{{old('post_code',auth()->user()->post_code)}}">
            <div class="error-box">
                @error('post_code')
                    {{$message}}
                @enderror
            </div>
        </div>
        <div class="address-form__box">
            <p class="address__ttl">住所</p>
            <input class="address-form__input" type="text" name="address" value="{{old('address',auth()->user()->address)}}">
            <div class="error-box">
                @error('address')
                    {{$message}}
                @enderror
            </div>
        </div>
        <div class="address-form__box">
            <p class="address-form__ttl">建物名</p>
            <input class="address-form__input" type="text" name="building" value="{{old('building',auth()->user()->building)}}">
        </div>
        <div class="address-form__submit-box">
            <button class="address-form__button">更新する</button>
        </div>
    </div>
</form>
@endsection