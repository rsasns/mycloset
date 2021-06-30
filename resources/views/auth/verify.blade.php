@extends('layouts.app')

@section('content')
@include('commons.navbar')
<div class="container">
    <div class="row justify-content-center">
        <div class="jumbotron">
            <h4>{{ __('メールアドレスをご確認ください') }}</h4>
            <p class="lead">
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('ご登録いただいたメールアドレスに確認用のリンクをお送りしました。') }}
                </div>
            @endif
            </p>
            <hr class="my-4">
                <p>{{ __('このページを表示するには、メールの確認が必要です。') }}<br>
                {{ __('もし確認用メールが送信されていない場合は、下記をクリックしてください。') }}</p>
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-color rounded-pill">{{ __('確認メールを再送信する') }}</button>
                </form>
        </div>
    </div>
</div>
@endsection
