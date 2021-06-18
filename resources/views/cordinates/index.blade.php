@if (count($cordinates) > 0 )
    @if(Request::routeIs('index'))
    <h1 class="d-block mb-0">#<span class="logo ml-2">HOT</span></h1>
    <div class="d-flex row">
        @foreach ($hotCordinates as $hotCordinate)
        <div class="col-md-4 p-2 text-wrap">
            <div class="card">
                <div class="card-header media">
                    @if($hotCordinate->user->image == null || $hotCordinate->user->image == '')
                        <div class="m-1">
                            <a class="link text-dark" href="{{ route('users.show', $hotCordinate->user->user_id) }}">
                            <i class="fas fa-user-circle fa-3x"></i>
                            </a>
                        </div>
                    @else
                        <div class="m-1">
                            <a class="link" href="{{ route('users.show', $hotCordinate->user->user_id) }}">
                                <img class="resize-circle-index" src="https://mycloset-sakataran.s3-ap-northeast-1.amazonaws.com/{{ $hotCordinate->user->image }}">
                            </a>
                        </div>
                    @endif
                    <div class="media-body">
                        <div class="row">
                            <div class="col">
                                    <h6 class="font-weigth-bold mt-2 mb-0">
                                    {{ $hotCordinate->user->name}}
                                    </h6>
                                @if ($hotCordinate->user->height_hidden != 1 && $hotCordinate->user->height !== null)
                                    <small class="text-secondary d-flex align-items-start">{{ $hotCordinate->user->height }}cm</small>
                                @endif
                            </div>
                            {{-- フォローボタンの表示 --}}
                            <div class="col text-right mt-2">
                                @if (Auth::id() != $hotCordinate->user->id)
                                    @if (Auth::user()->is_following($hotCordinate->user->id))
                                        {{-- アンフォロー --}}
                                        {!! Form::open(['route' => ['user.unfollow', $hotCordinate->user->id], 'method' => 'delete']) !!}
                                            {!! Form::button('<i class="fas fa-user-minus"></i>', ['class' => "btn btn-sm rounded-pill btn-secondary mr-1", 'type' => 'submit']) !!}
                                        {!! Form::close() !!}
                                    @else
                                        {{-- フォロー --}}
                                        {!! Form::open(['route' => ['user.follow', $hotCordinate->user->id]]) !!}
                                            {!! Form::button('<i class="fas fa-user-plus"></i>', ['class' => "btn btn-sm rounded-pill btn-outline-secondary mr-1", 'type' => 'submit']) !!}
                                        {!! Form::close() !!}
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <a class="link" href="{{ route('cordinates.show', $hotCordinate->id) }}">
                    <img class="card-img resize" src="https://mycloset-sakataran.s3-ap-northeast-1.amazonaws.com/{{ $hotCordinate->image }}">
                </a>
            <div class="card-footer p-1">
                {{-- いいねボタンの表示 --}}
                @if (Auth::user()->is_nice($hotCordinate->id))
                {{-- いいねを外す --}}
                <span>
                    {!! Form::open(['route' => ['user.unnice', $hotCordinate->id], 'method' => 'delete', 'class' => 'form-inline']) !!}
                        {!! Form::button('<i class="fas fa-heart"></i>', ['class' => "btn btn-sm rounded-pill btn-color", 'type' => 'submit']) !!}
                        <small class="ml-1">{{ $hotCordinate->nice_users_count }}スキ！</small>
                    {!! Form::close() !!}
                </span>
                @else
                    {{-- いいねをする --}}
                    <span>
                        {!! Form::open(['route' => ['user.onnice', $hotCordinate->id]]) !!}
                            {!! Form::button('<i class="fas fa-heart"></i>', ['class' => "btn btn-sm rounded-pill btn-outline-color", 'type' => 'submit']) !!}
                            <small class="ml-1">{{ $hotCordinate->nice_users_count }}スキ！</small>
                        {!! Form::close() !!}
                    </span>
                @endif
                {{-- クリップボタンの表示 --}}
                @if (Auth::user()->is_favorite($hotCordinate->id))
                {{-- クリップを外す --}}
                <span>
                    {!! Form::open(['route' => ['user.unfavorite', $hotCordinate->id], 'method' => 'delete', 'class' => 'form-inline']) !!}
                        {!! Form::button('<i class="fas fa-paperclip"></i>', ['class' => "btn btn-sm rounded-pill btn-dark", 'type' => 'submit']) !!}
                        <small class="ml-1">{{ $hotCordinate->favorites_users_count }}クリップ</small>
                    {!! Form::close() !!}
                </span>
                @else
                    {{-- クリップする --}}
                    <span>
                        {!! Form::open(['route' => ['user.favorite', $hotCordinate->id]]) !!}
                            {!! Form::button('<i class="fas fa-paperclip"></i>', ['class' => "btn btn-sm rounded-pill btn-outline-dark", 'type' => 'submit']) !!}
                            <small class="ml-1">{{ $hotCordinate->favorites_users_count }}クリップ</small>
                        {!! Form::close() !!}
                    </span>
                @endif
            </div>
            </div>
        </div>
        @endforeach
    </div>
    <h1 class="d-block mb-0">#<span class="logo ml-2">NEW</span></h1>
    @endif
    <div class="d-flex row">
        @foreach ($cordinates as $cordinate)
        <div class="col-md-4 p-2 text-wrap">
            <div class="card">
                <div class="card-header media">
                    @if($cordinate->user->image == null || $cordinate->user->image == '')
                        <div class="m-1">
                            <a class="link text-dark" href="{{ route('users.show', $cordinate->user->user_id) }}">
                            <i class="fas fa-user-circle fa-3x"></i>
                            </a>
                        </div>
                    @else
                        <div class="m-1">
                            <a class="link" href="{{ route('users.show', $cordinate->user->user_id) }}">
                                <img class="resize-circle-index" src="https://mycloset-sakataran.s3-ap-northeast-1.amazonaws.com/{{ $cordinate->user->image }}">
                            </a>
                        </div>
                    @endif
                    <div class="media-body">
                        <div class="row">
                            <div class="col">
                                    <h6 class="font-weigth-bold mt-2 mb-0">
                                    {{ $cordinate->user->name}}
                                    </h6>
                                @if ($cordinate->user->height_hidden != 1 && $cordinate->user->height !== null)
                                    <small class="text-secondary d-flex align-items-start">{{ $cordinate->user->height }}cm</small>
                                @endif
                            </div>
                            {{-- フォローボタンの表示 --}}
                            <div class="col text-right mt-2">
                                @include('commons.follow_button')
                            </div>
                        </div>
                    </div>
                </div>
                <a class="link" href="{{ route('cordinates.show', $cordinate->id) }}">
                    <img class="card-img resize" src="https://mycloset-sakataran.s3-ap-northeast-1.amazonaws.com/{{ $cordinate->image }}">
                </a>
            <div class="card-footer p-1">
                {{-- いいねボタンの表示 --}}
                @include('commons.nice_button')
                {{-- クリップボタンの表示 --}}
                @include('commons.clip_button')
            </div>
            </div>
        </div>
        @endforeach
    </div>
@endif