@extends('layouts.app')

@section('content')
<div class="container">
    <div class="inner center jumbotron">
        <div class="text-center">
            <h1 class="logo mb-4"><i class="fas fa-hashtag color mr-2"></i>My closet</h1>
        </div>
        <h4>{{ __('パスワードをリセットする') }}</h4>
        <p>登録したメールアドレスと新しいパスワードを入力してください。</p>
        <hr>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group row">
                <div class="col-md-10">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="メール">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-10">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="新しいパスワード">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-md-10">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"  placeholder="新しいパスワードを再入力">
                </div>
            </div>
            
            <div class="form-group row mb-0">
                <div class="col-md-10">
                    <button type="submit" class="btn btn-dark rounded-pill">
                        {{ __('パスワードをリセットする') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
