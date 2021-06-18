@if (Auth::check())
    @extends('layouts.app')

    @section('content')
        @include('commons.navbar')
        <div class="container">
            <div class="row">
                <div class="col-md-3 appear">
                    @include('commons.menubar')
                </div>
                <div class="col-md-9 mt-2">
                    <div class="mx-auto" style="width: 230px">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link active disabled" href="#">おすすめ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary" href="{{ route('feed') }}">タイムライン</a>
                            </li>
                        </ul>
                    </div>
                    {{-- 投稿一覧 --}}
                    @include('cordinates.index')
                </div>
                <div class="col-md-3 none">
                    {{-- 投稿フォーム --}}
                    <div class="mb-2">
                        @include('commons.menubar')
                    </div>
                    {{-- ユーザ一覧 --}}
                    @include('users.hot')
                </div>
            </div>
        </div>
    @endsection
@else
    @include('auth.login')
@endif