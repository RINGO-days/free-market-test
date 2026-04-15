@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/myList.css') }}">
@endsection

@section('main')
<div class="user-info">
    <div class="image-box">
        <img class="image" src="{{asset('storage/' .$user->image )}}" alt="ユーザー画像">
    </div>
    <h2 class="user-name">{{$user->name}}</h2>
    <a class="edit-profile__link" href="">プロフィールを編集</a>
</div>
<div class="tab-box">
    <div class="tab-box__inner">
        <a class="tab-rink" href="/my/List/?tab=ListedItem">出品した商品</a>
        <a class="tab-rink" href="/myList/?tab=PurchasedItem">購入した商品</a>
    </div>
</div>
<div class="product-box">
    @foreach($products as $product)
        <div class="product-card">
            <img class="product-card__image" src="{{$product->product->image}}" alt="商品画像">
            <span>{{$product->product->name}}</span>
        </div>
    @endforeach
</div>
@endsection