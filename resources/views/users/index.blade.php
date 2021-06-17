@foreach($attentionUsers as $attentionUser)
    <div class="media">
        @if($attentionUser->image == null || $attentionUser->image == '')
            <a class="link text-dark" href="{{ route('users.show', $attentionUser->user_id) }}">
            <i class="fas fa-user-circle"></i>
            </a>
        @else
            <a class="link" href="{{ route('users.show', $attentionUser->user_id) }}">
            <img class="resize-circle-show mr-3" src="https://mycloset-sakataran.s3-ap-northeast-1.amazonaws.com/{{ $attentionUser->image }}">
            </a>
        @endif
        <div class="media-body">
            <h5 class="mt-0">{{ $attentionUser->name }}</h5>
            <span class="mr-1">{{ $attentionUser->followers_count }}</span>
        </div>
    </div>
@endforeach