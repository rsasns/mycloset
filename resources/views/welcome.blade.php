@if (Auth::check())
    {{ Auth::user()->user_id }}
@else
    @include('auth.login')
@endif