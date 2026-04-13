@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/buy.css') }}">
@endsection

@section('main')
<div class="product-buy__box"  x-data="{selectedName:'未選択'}">
    <div class="product-buy__info-box">
        <div class="ttl__box">
            <img class="info__image" src="{{$product->image}}" alt="購入商品画像">
            <div class="ttl-price__box">
                <h2>商品名</h2>
                <span>¥ {{number_format($product->price)}}</span>
            </div>
        </div>
        <div class="payment__box">
            <h3>支払い方法</h3>
            <div class="payment-select__box">
                <select class="payment-select" name="payment" x-model="selectedName">
                    <option value="未選択" disabled selected>選択してください</option>
                    <option value="コンビニ支払い">コンビニ支払い</option>
                    <option value="カード支払い">カード支払い</option>
                </select>
                <span class="select-icon">▼</span>
            </div>
        </div>
        <div class="address__box">
            <div class="address-ttl__box">
                <h3>配送先</h3>
                <a class="address-change__link" href="">変更する</a>
            </div>
            <p>〒</p>
            <p>住所と建物名</p>  
            <!-- 認証ユーザー情報 -->
        </div>
    </div>
    <div class="confirm__box">
        <div class="confirm-item__box">
            <div class="confirm-price__box">
                <span class="confirm-item">商品代金</span>
                <span class="confirm-item">¥ {{number_format($product->price)}}</span>
            </div>
            <div class="confirm-payment__box">
                <span class="confirm-item">支払い方法</span>
                <span class="confirm-item" x-text="selectedName"></span>
            </div>
        </div>
        <div class="buy-button__box">
            <form action="">
                @csrf
                <button class="buy-button">購入する</button>
            </form>
        </div>
    </div>
</div>
@endsection