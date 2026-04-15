@extends('layouts.app' , ['nav' => false])

@section('css')
    <link rel="stylesheet" href="{{asset('css/verify-email.css')}}">
@endsection

@section('main')
<h2 class="content">登録していただいたメールアドレスに認証メールを送付いたしました。<br>メール認証を完了してください。</h2>
<div class="verify-box">
    <form action="">
        @csrf
        <button class="verify-button">認証はこちらから</button>
    </form>
    <div class="send-box">
        <form action="{{route('verification.send')}}" method="post">
            @csrf
            <button class="send-button">認証メールを再送する</button>
        </form>
        @if (session('status') === 'verification-link-sent')
            <div class="resend-box">
                <p>認証メールを再送信しました</p>
            </div>
        @endif
    </div>
</div>
@endsection