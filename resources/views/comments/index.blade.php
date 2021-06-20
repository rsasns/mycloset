<div class="row">
    <div class="col-md-12">
        <span><i class="far fa-comment-dots mr-1"></i>{{ $action_users->comments_count }}件のコメント</span>
        <p></p>
    @if(count($cordinate->comments) > 0)
        @foreach($cordinate->comments as $comment)
            <div class="d-flex  justify-content-between">
                <div class="media">
                    @if($comment->user->image == null || $comment->user->image == '')
                    <a class="link text-dark" href="{{ route('users.show', $comment->user->user_id) }}">
                    <i class="fas fa-user-circle fa-3x mr-3"></i>
                    </a>
                    @else
                    <a class="link" href="{{ route('users.show', $comment->user->user_id) }}">
                    <img class="resize-circle-index mr-3" src="https://mycloset-sakataran.s3-ap-northeast-1.amazonaws.com/{{ $comment->user->image }}">
                    </a>
                    @endif
                    <div class="media-body">
                        <span class="mt-0 mr-2">{{ $comment->user->name }}</span><spann class="small text-secondary">Posted by {{ $comment->created_at}}</spann>
                        <p>{!! nl2br($comment->comment) !!}</p>
                    </div>
                </div>
                    @if (Auth::id() == $comment->user_id || Auth::id() == $cordinate->user_id)
                    <div class="dropdown">
                      <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                        <div class="dropdown-menu dropdown-menu-right">
                            {!! Form::open(['url' => route('comments.destroy',$comment->id), 'method' => 'delete', 'onclick' => 'return confirm("本当に削除しますか？");']) !!}
                                {!! Form::submit('このコメントを削除する', ['class' => 'dropdown-item']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                    @endif
            </div>
        @endforeach
    @else
    <div class="alert alert-secondary" role="alert">
        コメントはありません
    </div>
    @endif
    </div>
    <div class="col-md-12">
        @include('commons.error_messages')
        @if (Auth::check())
        <hr>
        {!! Form::open(['url' => route('comments.store',$cordinate->id)]) !!}
            <div class="form-group">
                {!! Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '2']) !!}
                {!! Form::submit('コメントを投稿する', ['class' => 'btn btn-outline-dark btn-block rounded-pill']) !!}
            </div>
        {!! Form::close() !!}
        @else
        <div class="alert alert-secondary" role="alert">
          <h4>コメントするには<a class ="link text-dark" href="{{ route('signup.get') }}">新規登録</a>または<a class ="link text-dark" href="{{ route('index') }}">ログイン</a>が必要です</h4>
        </div>
        @endif
    </div>
</div>