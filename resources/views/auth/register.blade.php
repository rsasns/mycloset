@extends('layouts.app')

@section('content')
<div class="outer">
    <div class="inner">
        <div class="center jumbotron">
            <div class="text-center">
                <h1 class="logo mb-4"><i class="fas fa-hashtag color mr-2"></i>My closet</h1>
                
                @include('commons.error_messages')
                
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
                </div>
                <div class="col-md-12">
                    <a href="{{ url('login/facebook')}}" class="link text-dark font-weight-bold"><i class="fab fa-facebook mr-3"></i>Facebookでログイン</a>
                </div>
            </div>
        </div>
        <div class="center jumbotron p-3">
            <div class="text-center">
                <span>すでにアカウントをお持ちですか？</span><span><a class="color link font-weight-bold" href="/">ログインする</a></span>
            </div>
        </div>
    </div>
</div>
@endsection