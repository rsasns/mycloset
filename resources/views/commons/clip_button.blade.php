@if(Request::routeIs('cordinates.show'))
        @if (Auth::user()->is_favorite($cordinates->id))
            {{-- クリップを外す --}}
            <span>
                {!! Form::open(['route' => ['user.unfavorite', $cordinates->id], 'method' => 'delete', 'class' => 'form-inline']) !!}
                    {!! Form::button('<i class="fas fa-paperclip"></i>', ['class' => "btn rounded-pill btn-dark", 'type' => 'submit']) !!}
                    <small class="ml-1">{{ $favorites_users->favorites_users_count }}クリップ</small>
                {!! Form::close() !!}
            </span>
        @else
            {{-- クリップする --}}
            <span>
                {!! Form::open(['route' => ['user.favorite', $cordinates->id]]) !!}
                    {!! Form::button('<i class="fas fa-paperclip"></i>', ['class' => "btn rounded-pill btn-outline-dark", 'type' => 'submit']) !!}
                    <small class="ml-1">{{ $favorites_users->favorites_users_count }}クリップ</small>
                {!! Form::close() !!}
            </span>
        @endif
@else
        @if (Auth::user()->is_favorite($cordinate->id))
            {{-- クリップを外す --}}
            <span>
                {!! Form::open(['route' => ['user.unfavorite', $cordinate->id], 'method' => 'delete', 'class' => 'form-inline']) !!}
                    {!! Form::button('<i class="fas fa-paperclip"></i>', ['class' => "btn btn-sm rounded-pill btn-dark", 'type' => 'submit']) !!}
                    <small class="ml-1">{{ $cordinate->favorites_users_count }}クリップ</small>
                {!! Form::close() !!}
            </span>
        @else
            {{-- クリップする --}}
            <span>
                {!! Form::open(['route' => ['user.favorite', $cordinate->id]]) !!}
                    {!! Form::button('<i class="fas fa-paperclip"></i>', ['class' => "btn btn-sm rounded-pill btn-outline-dark", 'type' => 'submit']) !!}
                    <small class="ml-1">{{ $cordinate->favorites_users_count }}クリップ</small>
                {!! Form::close() !!}
            </span>
        @endif
@endif