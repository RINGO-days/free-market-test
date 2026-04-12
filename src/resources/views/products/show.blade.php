@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
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
            <div class="product-number_of_like__box">
                <form action="/like/{{$product->id}}" method="post">
                    @csrf
                    <button class="product-number_of_like__image-button">
                        @if($product->likeBy(auth()->user()))
                        <img src="/img/ハートロゴ_ピンク.png" alt="お気に入り登録">
                        @else
                        <img src="/img/ハートロゴ_デフォルト.png" alt="お気に入り解除">
                        @endif
                    </button>
                    <span class="product-number_of_like__number">{{$product->number_of_like}}</span>
                </form>
            </div>
            <div class="product-number_of_comment__box">
                <img src="/img/ふきだしロゴ.png" alt="">
                <span class="product-number_of_comment__number">{{$product->number_of_comment}}</span>
            </div>
        </div>
        <div class="">
            <a  class="product-buy__link" href="/buy/{{$product->id}}">購入手続きへ</a>
        </div>
        <h2>商品説明</h2>
        <div class="product-description__box">
            <p class="product-description">{{$product->description}}</p>
        </div>
        <h2>商品の情報</h2>
        <div class="product-category">
            <p class="product-category__ttl">カテゴリー</p>
            <div class="product-category__item__box">
            @foreach($product->categories as $category)
                <span class="product-category__item">{{$category->content}}</span>
            @endforeach
            </div>
        </div>
        <div class="product-condition">
            <p class="product-condition__ttl">商品の状態</p>
            <span class="product-condition__item">{{$product->condition->content}}</span>
        </div>
        <h2>コメント（{{$product->comments->count()}}）</h2>
        @if($product->comments->count() > 0)
            @foreach($product->comments as $comment)
                <div class="user-comment__box">
                    <div class="user-comment__user-info">
                        <img  class="user-image" src="/img/テストユーザープロフィール画像.png" alt="プロフィール画像"> <!--メール認証実装後にuser-imageにかえる-->
                        <span>{{$comment->user->name}}</span>
                    </div>
                    <div class="user-comment">
                        <span>{{$comment->comment}}</span>
                    </div>
                </div>
            @endforeach
        @else
            <p>こちらの商品へのコメントはありません</p>
        @endif
        <h2>商品へのコメント</h2>
        <form action="/comment/{{$product->id}}" method="post">
            @csrf
            <div class="product-comment__box">
                <textarea class="comment-textarea" name="comment" rows="5"></textarea>
            </div>
            @error('comment')
                {{$message}}
            @enderror
            <div class="product-comment__submit">
                <button class="product-comment__submit-button">コメントを送信する</button>
            </div>
        </form>
    </div>
</div>
@endsection