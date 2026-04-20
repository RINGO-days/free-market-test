@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('main')
<div class="tab-box">
    <div class="tab-box__inner">
        <a class="tab-link {{request('tab') !== 'myList' ? 'active' : ''}}" href="/?keyword={{request('keyword')}}">
            <span class="link-text {{request('tab') !== 'myList' ? 'active' : ''}}">おすすめ</span>
        </a>
        <a class="tab-link {{request('tab') === 'myList' ? 'active' : ''}}" href="/?tab=myList&keyword={{request('keyword')}}">
            <span class="link-text {{request('tab') === 'myList' ? 'active' : ''}}">マイリスト</span>
        </a>
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
    @if(count($products) == 0)
        <div class="empty-message">
            <p>該当の商品はありませんでした</p>
        </div>
    @endif
</div>
@endsection
