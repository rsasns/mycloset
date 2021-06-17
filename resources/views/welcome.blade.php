@if (Auth::check())
    @extends('layouts.app')

    @section('content')
        @include('commons.navbar')
        <div class="container">
            <div class="row">
                <div class="col-md-3 appear">
                    @include('commons.menubar')
                </div>
                <div class="col-md-9">
                    {{-- 投稿一覧 --}}
                    @include('cordinates.index')
                </div>
                <div class="col-md-3 none">
                    {{-- 投稿フォーム --}}
                    <div class="mb-2">
                        @include('commons.menubar')
                    </div>
                    {{-- ユーザ一覧 --}}
                    <p class="lead"><i class="fab fa-hotjar mr-1"></i>人気ユーザ</p>
                    <hr>
                    @foreach($attentionUsers as $attentionUser)
                        <div class="media mb-2">
                            @if($attentionUser->image == null || $attentionUser->image == '')
                                <a class="link text-dark" href="{{ route('users.show', $attentionUser->user_id) }}">
                                <i class="fas fa-user-circle fa-4x mr-3"></i>
                                </a>
                            @else
                                <a class="link" href="{{ route('users.show', $attentionUser->user_id) }}">
                                <img class="resize-circle-show mr-3" src="https://mycloset-sakataran.s3-ap-northeast-1.amazonaws.com/{{ $attentionUser->image }}">
                                </a>
                            @endif
                            <div class="media-body">
                                <h5 class="mt-0">{{ $attentionUser->name }}</h5>
                                <span class="mr-1"><span class="font-weight-bold">{{ $attentionUser->followers_count }}</span>フォロワー</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endsection
@else
    @include('auth.login')
@endif