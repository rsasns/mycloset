@extends('layouts.app')

@section('content')
<div class="outer">
    <div class="inner">
        <div class="text-center">
            <h1 class="logo mt-4 mb-4"><i class="fas fa-hashtag color mr-2"></i>My closet</h1>
            <div class="center jumbotron">
                @include('commons.error_messages')
                
                {!! Form::open(['route' => 'login.post']) !!}
                    <div class="form-group">
                        {!! Form::email('email', null, ['class' => 'form-control','placeholder' => 'メール']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::password('password', ['class' => 'form-control','placeholder' => 'パスワード']) !!}
                    </div>
                    {!! Form::submit('ログイン', ['class' => 'btn btn-dark btn-block rounded-pill']) !!}
                {!! Form::close() !!}
                <div class="social-login mb-0">
                    <span>または</span>
                </div>
                <div class="col-md-12 mt-2">
                    <a href="{{ url('login/facebook')}}" class="link text-dark font-weight-bold"><i class="fab fa-facebook mr-3"></i>Facebookでログイン</a>
                </div>
                <div class="col-md-12 mt-2">
                    <a href="{{ route('password.request') }}" class="link text-dark small">パスワードを忘れた場合<a>
                </div>
            </div>
        </div>
        <div class="center jumbotron p-3">
            <div class="text-center">    
                <span>アカウントをお持ちではありませんか？</span><span><a class="color link font-weight-bold" href="{{ route('signup.get') }}">登録する</a></span>
            </div>
        </div>
        <div class="mt-4 text-center">
                <span><a href="{{ route('login.guest') }}" class="link text-dark font-weight-bold"><i class="fas fa-user mr-3"></i>ゲストログイン<a></span>
        </div>
    </div>
</div>
@endsection