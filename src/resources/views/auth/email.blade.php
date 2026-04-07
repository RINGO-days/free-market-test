@extends('layouts.app' , ['nav' => false])

@section('css')
    <link rel="stylesheet" href="css/email.css">
@endsection

@section('main')
<h2 class="content">登録していただいたメールアドレスに認証メールを送付いたしました。<br>メール認証を完了してください。</h2>
<div class="verify-box">
    <form action="">
        @csrf
        <button class="verify-button">認証はこちらから</button>
    </form>
    <!-- メール再送 -->
</div>
@endsection