@extends('layouts.app')

@section('content')
<div class="outer">
    <div class="inner center jumbotron">
        <div class="text-center">
            <h1 class="logo mb-4">My closet</h1>
            {!! Form::open(['route' => 'signup.post']) !!}
                <div class="form-group">
                    {!! Form::text('user_id', null, ['class' => 'form-control','placeholder' => 'ユーザID']) !!}
                </div>
                <div class="form-group">
                    {!! Form::email('email', null, ['class' => 'form-control','placeholder' => 'メール']) !!}
                </div>
                <div class="form-group">
                    {!! Form::password('password', ['class' => 'form-control','placeholder' => 'パスワード']) !!}
                </div>
                {!! Form::submit('新規登録', ['class' => 'btn btn-dark btn-block rounded-pill']) !!}
            {!! Form::close() !!}
            <div class="social-login">
                <span>または</span>
                <div class="row mt-2">
                    <div class = "col-4">
                        <i class="fab fa-facebook fa-2x"></i>
                    </div>
                    <div class = "col-4">
                        <i class="fab fa-twitter-square fa-2x"></i>
                    </div>
                    <div class = "col-4">
                        <i class="fab fa-line fa-2x"></i>
                    </div>
                </div>
            </div>
            <span>すでにアカウントをお持ちですか？</span><span><a class="color font-weight-bold" href="/">ログインする</a></span>
        </div>
    </div>
</div>
@endsection