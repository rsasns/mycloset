@if (count($cordinates) > 0 )
    @if(Request::routeIs('index'))
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
                            <div class="col text-right mt-2">
                                @if (Auth::id() != $cordinate->user->id)
                                    @if (Auth::user()->is_following($cordinate->user->id))
                                        {{-- アンフォローボタンのフォーム --}}
                                        {!! Form::open(['route' => ['user.unfollow', $cordinate->user->id], 'method' => 'delete']) !!}
                                            {!! Form::submit('フォロー中', ['class' => "btn btn-sm rounded-pill btn-secondary"]) !!}
                                        {!! Form::close() !!}
                                    @else
                                        {{-- フォローボタンのフォーム --}}
                                        {!! Form::open(['route' => ['user.follow', $cordinate->user->id]]) !!}
                                            {!! Form::submit('フォロー', ['class' => "btn btn-sm rounded-pill btn-outline-secondary"]) !!}
                                        {!! Form::close() !!}
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <a class="link" href="{{ route('cordinates.show', $cordinate->id) }}">
                    <img class="card-img resize" src="https://mycloset-sakataran.s3-ap-northeast-1.amazonaws.com/{{ $cordinate->image }}">
                </a>
            <div class="card-footer p-1">
                <span><button type="button" class="btn btn-sm btn-outline-color rounded-pill mr-2"><i class="fas fa-heart"></i></button><small>xxxスキ！</small></span>
                <span><button type="button" class="btn btn-sm btn-outline-dark rounded-pill mr-2"><i class="fas fa-paperclip"></i></button><small>xxxクリップ</small></span>
            </div>
            </div>
        </div>
        @endforeach
    </div>
@endif