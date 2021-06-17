@if (Auth::id() != $user->id)
    @if (Auth::user()->is_following($user->id))
        {{-- アンフォローボタンのフォーム --}}
        {!! Form::open(['route' => ['user.unfollow', $user->id], 'method' => 'delete']) !!}
            {!! Form::submit('フォロー中', ['class' => "btn rounded-pill btn-color"]) !!}
        {!! Form::close() !!}
    @else
        {{-- フォローボタンのフォーム --}}
        {!! Form::open(['route' => ['user.follow', $user->id]]) !!}
            {!! Form::submit('フォローする', ['class' => "btn rounded-pill btn-outline-color"]) !!}
        {!! Form::close() !!}
    @endif
@endif