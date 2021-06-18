@extends('layouts.app')

@section('content')
    @include('commons.navbar')
    <div class="container">
        <div class="row col">
            <p><a class="link text-dark" href="{{ route('users.show', $user->user_id) }}"><i class="fas fa-arrow-left mr-2"></i>プロフィールへ戻る</a></p>
        </div>
        <div class="row col mb-2">
            @if($user->image == null || $user->image == '')
                <a class="link text-dark mr-2" href="{{ route('users.show', $user->user_id) }}">
                <i class="fas fa-user-circle fa-4x"></i>
                </a>
            @else
                <a class="link mr-2" href="{{ route('users.show', $user->user_id) }}">
                <img class="resize-circle-show" src="https://mycloset-sakataran.s3-ap-northeast-1.amazonaws.com/{{ $user->image }}">
                </a>
            @endif
            <h4 class="mt-2">{{ $user->name }}</h4>
        </div>
        <nav class="nav nav-pills nav-fill mb-4">
            <a href="{{ route('users.followers', ['user_id' => $user->user_id]) }}" class="nav-item nav-link text-dark link {{ Request::routeIs('users.followers') ? 'active' : '' }}">
            フォロワー
            </a>
            <a href="{{ route('users.followings', ['user_id' => $user->user_id]) }}" class="nav-item nav-link active btn-color link disabled {{ Request::routeIs('users.followings') ? 'active' : '' }}">
            フォロー中
            </a>
        </nav>
        @include('users.users')
    </div>
@endsection