@if(Request::routeIs('users.show') || Request::routeIs('users.favorites') || Request::routeIs('users.followers') || Request::routeIs('users.followings'))
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
@else
    @if (Auth::id() != $cordinate->user->id)
        @if (Auth::user()->is_following($cordinate->user->id))
            {{-- アンフォロー --}}
            {!! Form::open(['route' => ['user.unfollow', $cordinate->user->id], 'method' => 'delete']) !!}
                {!! Form::button('<i class="fas fa-user-minus"></i>', ['class' => "btn btn-sm rounded-pill btn-secondary mr-1", 'type' => 'submit']) !!}
            {!! Form::close() !!}
        @else
            {{-- フォロー --}}
                {!! Form::open(['route' => ['user.follow', $cordinate->user->id]]) !!}
                    {!! Form::button('<i class="fas fa-user-plus"></i>', ['class' => "btn btn-sm rounded-pill btn-outline-secondary mr-1", 'type' => 'submit']) !!}
                {!! Form::close() !!}
        @endif
    @endif
@endif