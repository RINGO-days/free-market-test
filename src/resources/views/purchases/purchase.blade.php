@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('main')
@if(session('cancel'))
    <div class="flash-message cancel">
        {{session('cancel')}}
    </div>
@endif
@if(session('success'))
<div class="flash-message success">
        {{session('success')}}
    </div>
@endif
<div class="product-buy__box">
    <div class="product-buy__info-box">
        <div class="ttl__box">
            <img class="info__image" src="{{asset('storage/' . $product->image)}}" alt="購入商品画像">
            <div class="ttl-price__box">
                <h2>商品名</h2>
                <span>¥ {{number_format($product->price)}}</span>
            </div>
        </div>
        <div class="payment__box">
            <h3>支払い方法</h3>
            <div class="payment-select__box">
                <form action="/payment/update">
                    @csrf
                    @method('patch')
                    <select class="payment-select" name="payment">
                        <option value="未選択" disabled selected>選択してください</option>
                        <option value="コンビニ支払い">コンビニ支払い
                            <input type="submit">
                        </option>
                        <option value="カード支払い">カード支払い</option>
                    </select>
                    <span class="select-icon">▼</span>
                </form>
            </div>
            <div class="error-box">
                @error('payment')
                    <span class="error-message">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="address__box">
            <div class="address-ttl__box">
                <h3>配送先</h3>
                <a class="address-change__link" href="/purchase/newAddress/{{$product->id}}">変更する</a>
            </div>
            <p>〒{{session('post_code') ?? $user->post_code}}</p>
            <p>{{session('address') ?? $user->address}}<br>{{session()->exists('building') ? session('building') : $user->building}}</p>
            <input type="hidden" name="post_code" value="{{session('post_code') ?? $user->post_code}}">
            <input type="hidden" name="address" value="{{session('address') ?? $user->address}}">
            <input type="hidden" name="building" value="{{session()->exists('building') ? session('building') : $user->building}}">
        </div>
    </div>
    <div class="confirm-box">
        <table class="confirm__table">
            <tr class="confirm-item__row">
                <th class="confirm-item">商品代金</th>
                <td class="confirm-item">¥ {{number_format($product->price)}}</td>
            </tr>
            <tr class="confirm-item__row">
                <th class="confirm-item">支払い方法</th>
                <td class="confirm-item"></td>
            </tr>
        </table>
        <form action="/purchase/checkout/{{$product->id}}" method="post">
            <div class="buy-button__box">
                @csrf
                <button class="buy-button">購入する</button>
            </div>
        </form>
    </div>
</div>
<!-- ここからAlpine.jsを利用したブラウザのリロードを挟まない小計画面の変更のコードです。利用する場合は上記のformタグ内のコードを消す、もしくはコメントアウトする。 -->
<!-- <form action="/purchase/checkout/{{$product->id}}" method="post">
    <div class="product-buy__box"  x-data="{selectedName:'未選択'}">
        <div class="product-buy__info-box">
            <div class="ttl__box">
                <img class="info__image" src="{{asset('storage/' . $product->image)}}" alt="購入商品画像">
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
                <div class="error-box">
                    @error('payment')
                        <span class="error-message">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="address__box">
                <div class="address-ttl__box">
                    <h3>配送先</h3>
                    <a class="address-change__link" href="/purchase/newAddress/{{$product->id}}">変更する</a>
                </div>
                <p>〒{{session('post_code') ?? $user->post_code}}</p>
                <p>{{session('address') ?? $user->address}}<br>{{session()->exists('building') ? session('building') : $user->building}}</p>
                <input type="hidden" name="post_code" value="{{session('post_code') ?? $user->post_code}}">
                <input type="hidden" name="address" value="{{session('address') ?? $user->address}}">
                <input type="hidden" name="building" value="{{session()->exists('building') ? session('building') : $user->building}}">
            </div>
        </div>
        <div class="confirm-box">
            <table class="confirm__table">
                <tr class="confirm-item__row">
                    <th class="confirm-item">商品代金</th>
                    <td class="confirm-item">¥ {{number_format($product->price)}}</td>
                </tr>
                <tr class="confirm-item__row">
                    <th class="confirm-item">支払い方法</th>
                    <td class="confirm-item" x-text="selectedName"></td>
                </tr>
            </table>
            <div class="buy-button__box">
                @csrf
                <button class="buy-button">購入する</button>
            </div>
        </div>
    </div>
</form> -->
@endsection