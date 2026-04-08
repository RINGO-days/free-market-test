@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="css/show.css">
@endsection

@section('main')
<div class="product-show__box">
    <aside class="product-image__sidebar">
        <img class="product-image" src="{{$product->image}}" alt="">
    </aside>
    <div class="product-show__content">
        <h1 class="product-ttl">{{$product->name}}</h1>
        <p class="product-brand">{{$product->brand}}</p>
        <p class="product-price">{{$product->format_price}}</p>
        <div class="product-number__box">
            <label>
                <img class="product-likes" src="/img/ハートロゴ_デフォルト.png" alt="">
            </label>
            <label for="">
                <img src="/img/ふきだしロゴ.png" alt="">
            </label>
        </div>
        <a  class="product-buy__link" href="">購入手続きへ</a>
        <h2>商品説明</h2>
        <div class="product-description__box">
            <p class="product-description">{{$product->description}}</p>
        </div>
        <h2>商品の情報</h2>
        <div class="product-category">
            <span>カテゴリー</span>
            
        </div>
    </div>
</div>
@endsection