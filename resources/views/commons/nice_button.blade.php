@if(Request::routeIs('cordinates.show'))
        @if (Auth::user()->is_nice($cordinate->id))
            {{-- いいねを外す --}}
            <span>
                {!! Form::open(['route' => ['user.unnice', $cordinate->id], 'method' => 'delete', 'class' => 'form-inline']) !!}
                    {!! Form::button('<i class="fas fa-heart"></i>', ['class' => "btn rounded-pill btn-color", 'type' => 'submit']) !!}
                    <small class="ml-1">{{ $action_users->nice_users_count }}スキ！</small>
                {!! Form::close() !!}
            </span>
        @else
            {{-- いいねをする --}}
            <span>
                {!! Form::open(['route' => ['user.onnice', $cordinate->id]]) !!}
                    {!! Form::button('<i class="fas fa-heart"></i>', ['class' => "btn rounded-pill btn-outline-color", 'type' => 'submit']) !!}
                    <small class="ml-1">{{ $action_users->nice_users_count }}スキ！</small>
                {!! Form::close() !!}
            </span>
        @endif
@else
        @if (Auth::user()->is_nice($cordinate->id))
            {{-- いいねを外す --}}
            <span>
                {!! Form::open(['route' => ['user.unnice', $cordinate->id], 'method' => 'delete', 'class' => 'form-inline']) !!}
                    {!! Form::button('<i class="fas fa-heart"></i>', ['class' => "btn btn-sm rounded-pill btn-color", 'type' => 'submit']) !!}
                    <small class="ml-1">{{ $cordinate->nice_users_count }}スキ！</small>
                {!! Form::close() !!}
            </span>
        @else
            {{-- いいねをする --}}
            <span>
                {!! Form::open(['route' => ['user.onnice', $cordinate->id]]) !!}
                    {!! Form::button('<i class="fas fa-heart"></i>', ['class' => "btn btn-sm rounded-pill btn-outline-color", 'type' => 'submit']) !!}
                    <small class="ml-1">{{ $cordinate->nice_users_count }}スキ！</small>
                {!! Form::close() !!}
            </span>
        @endif
@endif