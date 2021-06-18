@extends('layouts.app')

@section('content')
    @include('commons.navbar')
    <div class="container">
        <div class="row">
            <div class="col-md-4 text-center">
                @if($user->image == null || $user->image == '')
                    <i class="fas fa-user-circle fa-9x"></i>
                @else
                    <img class="resize-circle" src="https://mycloset-sakataran.s3-ap-northeast-1.amazonaws.com/{{ $user->image }}">
                @endif
            </div>
            <div class="col-md-8">
                <div class="d-flex justify-content-between">
                <h3>{{ $user->name }}</h3>
                <p></p>
                {{-- フォローボタン　--}}
                @include('commons.follow_button')
                </div>
                <p></p>
                <div class="d-flex justify-content-start">
                    <span class="mr-4">
                        <a href="{{ route('users.followers', ['user_id' => $user->user_id]) }}" class="text-dark link {{ Request::routeIs('users.followers') ? 'active' : '' }}">
                        <span class="font-weight-bold">{{ $user->followers_count }}</span>フォロワー
                        </a>
                    </span>
                    <span class="mr-4">
                        <a href="{{ route('users.followings', ['user_id' => $user->user_id]) }}" class="text-dark link {{ Request::routeIs('users.followings') ? 'active' : '' }}">
                        <span class="font-weight-bold">{{ $user->followings_count }}</span>フォロー中
                        </a>
                    </span>
                    <span>
                        <a href="{{ route('users.favorites', ['user_id' => $user->user_id]) }}" class="text-dark link {{ Request::routeIs('users.favorites') ? 'active' : '' }}">
                        <span class="font-weight-bold">{{ $user->favorites_count }}</span>クリップ
                        </a>
                    </span>
                </div>
            </div>
            <div class="col-md-12">
                <span class="font-weight-bold line-height mr-4">{{ '@'.$user->user_id }}</span>
                    @if ($user->height_hidden != 1 && $user->height !== null)
                        <span class="mr-1">{{ $user->height }}cm</span>
                    @endif
                    @if ($user->sex_hidden != 1 && $user->sex !== null)
                        @if ($user->sex == 0 )
                            <span class="mr-1">MEN</span>
                        @else
                            <span class="mr-1">WOMEN</span>
                        @endif
                    @endif
                    @if ($user->age_hidden != 1 && $user->age !== null)
                        <span>age{{ $user->age }}</span>
                    @endif
            </div>
            <div class="col-md-12">
                <p>{{ $user->bio }}</p>
            </div>
            <div class="col-md-12">
                <p><a target="_brank" href="{{ $user->homepage }}" class="link color">{{ $user->homepage }}</a></p>
            </div>
            <div class="col-md-12">
                @if ($user->instagram != null)
                    <a target="_brank" class ="link text-dark" href="https://www.instagram.com/{{ $user->instagram }}" target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-instagram fa-2x  mr-3"></i>
                    </a>
                @endif
                @if ($user->twitter != null )
                    <a target="_brank" class ="link text-dark" href="https://twitter.com/{{ $user->twitter }}" target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-twitter fa-2x mr-3"></i>
                    </a>
                @endif
                @if ($user->facebook != null)
                    <a target="_brank" class ="link text-dark" href="https://www.facebook.com/{{ $user->facebook }}" target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-facebook fa-2x"></i>
                    </a>
                @endif
                <p></p>
            </div>
            <div class="col-md-12 mb-2">
                @if (Auth::id() === $user->id)
                    {!! link_to_route('users.edit', 'プロフィールを編集する', ['user' => $user->user_id], ['class' => 'btn btn-block btn-outline-dark rounded-pill']) !!}
                    {!! link_to_route('cordinates.create', 'コーディネートを投稿する', ['user' => $user->user_id], ['class' => 'btn btn-block btn-outline-color rounded-pill']) !!}
                @endif
            </div>
        </div>
        <div class="mx-auto" style="width:160px">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link text-secondary" href="{{ route('users.show', $user->user_id) }}">投稿</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active disabled" href="#">クリップ</a>
                </li>
            </ul>
        </div>
        @if (count($favorites) > 0)
            <div class="row d-flex text-center">
            @foreach ($favorites as $favorite)
                <div class="col-4 p-2">
                    <a class="link" href="{{ route('cordinates.show', $favorite->id) }}">
                        <img class="resize" src="https://mycloset-sakataran.s3-ap-northeast-1.amazonaws.com/{{ $favorite->image }}">
                    </a>
                </div>
            @endforeach
            </div>
        @else
            <div class="row mt-2">
                <div class="col-12">
                    <div class="alert alert-secondary text-center" role="alert">
                        <i class="fas fa-paperclip fa-5x"></i>
                        <h2>クリップがありません</h2>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection