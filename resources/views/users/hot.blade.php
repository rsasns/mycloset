<p class="lead"><i class="fab fa-hotjar mr-1"></i>人気ユーザ</p>
<hr>
@foreach($attentionUsers as $attentionUser)
    <div class="media mb-2">
        @if($attentionUser->image == null || $attentionUser->image == '')
            <a class="link text-dark" href="{{ route('users.show', $attentionUser->user_id) }}">
                <i class="fas fa-user-circle fa-3x mr-3"></i>
            </a>
        @else
            <a class="link" href="{{ route('users.show', $attentionUser->user_id) }}">
                <img class="resize-circle-index mr-3" src="https://mycloset-sakataran.s3-ap-northeast-1.amazonaws.com/{{ $attentionUser->image }}">
            </a>
        @endif
            <div class="media-body">
                <div class="row">
                    <div class="col">
                        <h6 class="mt-0 mb-0">{{ $attentionUser->name }}</h6>
                        <small class="mr-1"><small class="font-weight-bold">{{ $attentionUser->followers_count }}</small>フォロワー</small>
                    </div>
                <div class="col text-right mt-2">
                @if (Auth::id() != $attentionUser->id)
                    @if (Auth::user()->is_following($attentionUser->id))
                        {{-- アンフォローボタンのフォーム --}}
                        {!! Form::open(['route' => ['user.unfollow', $attentionUser->id], 'method' => 'delete']) !!}
                            {!! Form::submit('フォロー中', ['class' => "btn btn-sm rounded-pill btn-secondary"]) !!}
                        {!! Form::close() !!}
                    @else
                        {{-- フォローボタンのフォーム --}}
                        {!! Form::open(['route' => ['user.follow', $attentionUser->id]]) !!}
                            {!! Form::submit('フォロー', ['class' => "btn btn-sm rounded-pill btn-outline-secondary"]) !!}
                        {!! Form::close() !!}
                    @endif
                @endif
                </div>
                </div>
            </div>
    </div>
@endforeach
{{-- ページネーションのリンク --}}
{{ $attentionUsers->links('vendor.pagination.simple-default') }}