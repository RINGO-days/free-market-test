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
        <div class="product-card">
            <a class="product-card-link" href="/show/{{$product->id}}" id="card">
                <img class="product-card__image" src="{{asset('storage/' . $product->image)}}" alt="商品画像">
                <span>{{$product->name}}</span>
                @if($product->status === 2)
                    <span class="sold-icon">sold</span>
                @endif
            </a>
        </div>
    @endforeach
</div>
@endsection
