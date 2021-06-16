@extends('layouts.app')

@section('content')
<div class="outer">
    <div class="inner center jumbotron">
        <div class="text-center">
            <h1 class="logo mb-4">My closet</h1>
            
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
            <span>アカウントをお持ちではありませんか？</span><span>{!! link_to_route('signup.get', '登録する', [],['class' => 'color link font-weight-bold']) !!}</span>
        </div>
    </div>
</div
@endsection