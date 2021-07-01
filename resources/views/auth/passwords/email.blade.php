@extends('layouts.app')

@section('content')
<div class="container">
    <a class="link text-dark" href="{{ route('index') }}"><i class="fas fa-arrow-left mr-2"></i>ログイン画面へ戻る</a>
    <div class="text-center mt-4 mb-4">
        <h1 class="logo mb-4"><i class="fas fa-hashtag color mr-2"></i>My closet</h1>
    </div>
    <div class="inner center jumbotron">
        <p></p>
        <h4 class="logo">{{ __('パスワードを忘れた場合') }}</h4>
        <p>登録したメールアドレスにパスワード再設定用のメールを送信します。</p>
        <hr>
        <div>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group row">
                    <div class="col-md-12">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="メール">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="ml-1 form-group row">
                    <button type="submit" class="btn btn-dark rounded-pill">
                        {{ __('メールを送信する') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
