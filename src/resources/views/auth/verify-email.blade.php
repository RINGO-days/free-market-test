@extends('layouts.app' , ['nav' => false])

@section('css')
    <link rel="stylesheet" href="{{asset('css/verify-email.css')}}">
@endsection

@section('main')
@if (session('status') === 'verification-link-sent')
    <div class="flash-message success">
        <span>認証メールを再送信しました</span>
    </div>
@endif
<h2 class="content">登録していただいたメールアドレスに認証メールを送付いたしました。<br>メール認証を完了してください。</h2>
<div class="verify-box">
    <a class="verify-button" href="http://localhost:8025">認証はこちらから</a>
    <div class="send-box">
        <form action="{{route('verification.send')}}" method="post">
            @csrf
            <button class="send-button">認証メールを再送する</button>
        </form>
    </div>
</div>
@endsection