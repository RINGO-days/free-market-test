@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('main')
<form action="/product/listing" method="post" enctype="multipart/form-data">
    @csrf
    <div class="sell__box">
        <div class="main-ttl__box">
            <h1 class="ttl">商品の出品</h1>
        </div>
        <div class="ttl-box">
            <span>商品画像</span>
            <div class="error-box">
                @error('image')
                <span class="error-message">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="image__box">
            <label class="image__input-button" for="image__input">
                <span class="image__input-button__text">ファイルを選択</span>
                <input class="image__input" type="file" id="image__input" name="image">
            </label>
        </div>
        <h2 class="section-ttl">商品の詳細</h2>
        <div class="ttl-box">
            <span>カテゴリー</span>
            <div class="error-box">
                @error('category')
                <span class="error-message">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="category__box">
            @foreach($categories as $category)
                <label>
                    <input class="category__checkbox" type="checkbox" name="category[]" value="{{$category->id}}" {{(is_array(old('category')) && in_array($category->id , old('category'))) ? 'checked' : ''}}>
                    <span class="category-button">{{$category->content}}</span>
                </label>
            @endforeach
        </div>
        <div class="condition__box">
            <div class="ttl-box">
                <span>商品の状態</span>
                <div class="error-box">
                    @error('condition_id')
                        <span class="error-message">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <select class="condition__select" name="condition_id" class="condition-select">
                <option value="" disabled selected>選択してください</option>
                @foreach($conditions as $condition)
                    <option value="{{$condition->id}}" {{(old('condition_id') == $condition->id) ? 'selected' : ''}}>{{$condition->content}}</option>
                @endforeach
            </select>
            <span class="select-icon">▼</span>
        </div>
        <h2 class="section-ttl">商品名と説明</h2>
        <div class="content__box">
            <div class="ttl-box">
                <span>商品名</span>
                <div class="error-box">
                    @error('name')
                        <span class="error-message">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <input class="content__input" type="text" name="name" value="{{old('name')}}">
        </div>
        <div class="content__box">
            <div class="ttl-box">
                <span>ブランド名</span>
            </div>
            <input class="content__input" type="text" name="brand" value="{{old('brand')}}">
        </div>
        <div class="textarea__box">
            <div class="ttl-box">
                <span>商品の説明</span>
                <div class="error-box">
                    @error('description')
                        <span class="error-message">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <textarea class="content__textarea" name="description" rows="5">{{old('description')}}</textarea>
        </div>
        <div class="content__box">
            <div class="ttl-box">
                <span>販売価格</span>
                <div class="error-box">
                    @error('price')
                        <span class="error-message">{{$message}}</span>
                    @enderror
                </div>
            </div>
                <input class="content__input-price" type="number" name="price" value="{{old('price')}}">
                <span class="jpy-icon">￥</span>
            </div>
        <button class="sell-button">出品する</button>
    </div>
</form>
@endsection