@if (Auth::check())
    {!! link_to_route('cordinates.create', '投稿する', ['user' => Auth::user()->user_id], ['class' => 'btn btn-block btn-outline-color rounded-pill']) !!}
@endif