@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/myList.css') }}">
@endsection

@section('main')
@if(session('success'))
    <div class="flash-message success">
        {{session('success')}}
    </div>
@endif
<div class="user-info">
    <div class="image-box">
        <img class="image" src="{{$user->profile_image}}" alt="ユーザー画像">
    </div>
    <h2 class="user-name">{{$user->name}}</h2>
    <a class="edit-profile__link" href="/myList/editProfile">プロフィールを編集</a>
</div>
<div class="tab-box">
    <div class="tab-box__inner">
        <a class="tab-link {{request('page') !== 'buy' ? 'active' : ''}}" href="/myList/?page=sell">
            <span class="link-text {{request('page') !== 'buy' ? 'active' : ''}}">出品した商品</span>
        </a>
        <a class="tab-link {{request('page') === 'buy' ? 'active' : ''}}" href="/myList/?page=buy">
            <span class="link-text {{request('page') === 'buy' ? 'active' : ''}}">購入した商品</span>
        </a>
    </div>
</div>
<div class="product-box">
    @foreach($products as $product)
        <div class="product-card">
            <img class="product-card__image" src="{{asset('storage/' .$product->image )}}" alt="商品画像">
            <span>{{$product->name}}</span>
        </div>
    @endforeach
    @if($products->isEmpty())
        <div class="empty-message">
            @if(request('page') !== 'buy')
                <p>出品した商品はありません</p>
            @else
                <p>購入した商品はありません</p>
            @endif
        </div>
    @endif
</div>
@endsection