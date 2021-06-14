@extends('layouts.app')

@section('content')
    @if (Auth::check())
        {{ Auth::user()->user_id }}
    @else
        @include('auth.login')
    @endif
@endsection