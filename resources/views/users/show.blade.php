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
                <h3>{{ $user->user_id }}</h3>
                <p></p>
                @if (Auth::id() != $user->id)
                    @if (Auth::user()->is_following($user->id))
                        {{-- アンフォローボタンのフォーム --}}
                        <button type="button" class="btn rounded-pill btn-color">フォロー中</button>
                    @else
                        {{-- フォローボタンのフォーム --}}
                        <button type="button" class="btn rounded-pill btn-outline-color">フォロー</button>
                    @endif
                @endif
                </div>
                <p></p>
                <div class="d-flex justify-content-start">
                    <span class="mr-4">xxxフォロワー</span><span class="mr-4">xxxフォロー中</span><span>xxxクリップ</span>
                </div>
            </div>
            <div class="col-md-12">
                <span class="font-weight-bold line-height mr-4">{{ $user->name }}</span>
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
                <p><a href="{{ $user->homepage }}" class="link color">{{ $user->homepage }}</a></p>
            </div>
            <div class="col-md-12">
                @if ($user->instagram != null)
                    <a class ="link text-dark" href="https://www.instagram.com/".{{ $user->instagram }} target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-instagram fa-2x  mr-3"></i>
                    </a>
                @endif
                @if ($user->twitter != null )
                    <a class ="link text-dark" href="https://twitter.com/".{{ $user->twitter }} target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-twitter fa-2x mr-3"></i>
                    </a>
                @endif
                @if ($user->facebook != null)
                    <a class ="link text-dark" href="https://www.facebook.com/".{{ $user->facebook }} target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-facebook fa-2x"></i>
                    </a>
                @endif
                <p></p>
            </div>
            <div class="col-md-12">
                @if (Auth::id() === $user->id)
                    {!! link_to_route('users.edit', 'プロフィールを編集する', ['user' => $user->user_id], ['class' => 'btn btn-block btn-outline-dark rounded-pill']) !!}
                    {!! link_to_route('cordinates.create', 'コーディネートを投稿する', ['user' => $user->user_id], ['class' => 'btn btn-block btn-outline-color rounded-pill']) !!}
                @endif
            </div>
        </div>
        @if (count($cordinates) > 0)
            <div class="row d-flex text-center">
            @foreach ($cordinates as $cordinate)
                <div class="col-4 p-2">
                    <a class="link" href="{{ route('cordinates.show', $cordinate->id) }}">
                        <img class="resize" src="https://mycloset-sakataran.s3-ap-northeast-1.amazonaws.com/{{ $cordinate->image }}">
                    </a>
                </div>
            @endforeach
            </div>
        @else
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-secondary" role="alert">
                        <i class="far fa-sticky-note fa-7x"></i>
                        <h1>投稿がありません</h1>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection