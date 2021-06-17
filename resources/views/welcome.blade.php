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
                    {{-- タイムライン --}}
                    @include('cordinates.index')
                </div>
                <div class="col-md-3 none">
                    @include('commons.menubar')
                </div>
            </div>
        </div>
    @endsection
@else
    @include('auth.login')
@endif