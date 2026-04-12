@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('main')
<div class="tab-box">
    <div class="tab-box__inner">
        <a class="tab-rink" href="/?tab=recommend">おすすめ</a>
        <a class="tab-rink" href="/?tab=myList">マイリスト</a>
    </div>
</div>
<div class="product-box">
    @foreach($products as $product)
        <a href="/show/{{$product->id}}">
            <div class="product-card">
                <img class="product-card__image" src="{{$product->image}}" alt="商品画像">
                <span>{{$product->name}}</span>
        </div>
        </a>
    @endforeach
</div>
@endsection
