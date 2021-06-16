@if (Auth::check())
    @extends('layouts.app')

    @section('content')
        @include('commons.navbar')
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    {{-- ログインユーザのタイムライン --}}
                    {{-- @include('cordinates.cordinates') --}}
                </div>
                <div class="col-md-3">
                    @if (Auth::check())
                    {!! link_to_route('cordinates.create', '投稿する', ['user' => Auth::user()->user_id], ['class' => 'btn btn-block btn-outline-color rounded-pill']) !!}
                    @endif
                </div>
            </div>
        </div>
    @endsection
@else
    @include('auth.login')
@endif