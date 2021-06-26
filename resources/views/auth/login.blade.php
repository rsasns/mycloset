@extends('layouts.app')

@section('content')
<div class="outer">
    <div class="inner center jumbotron">
        <div class="text-center">
            <h1 class="logo mb-4"><i class="fas fa-hashtag color mr-2"></i>My closet</h1>
            
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
            <!--<div class="social-login">-->
            <!--    <span>または</span>-->
            <!--    <div class="row mt-2">-->
            <!--        <div class = "col-6">-->
            <!--            <i class="fab fa-facebook fa-2x"></i>-->
            <!--        </div>-->
            <!--        <div class = "col-6">-->
            <!--            <i class="fab fa-twitter-square fa-2x"></i>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <div class="mt-2">
                <span>アカウントをお持ちではありませんか？</span><span>{!! link_to_route('signup.get', '登録する', [],['class' => 'color link font-weight-bold']) !!}</span>
            </div>
            <div class="mt-4">
                <span><a href="{{ route('login.guest') }}" class="link text-dark font-weight-bold"><i class="fas fa-user mr-3"></i>ゲストログイン<a></span>
            </div>
        </div>
    </div>
</div
@endsection