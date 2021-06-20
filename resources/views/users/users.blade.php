{{-- フォロー、フォロワー一覧　--}}
@if (count($users) > 0)
    <div class="container">
    @foreach ($users as $user)
        <div class="row">
            <div class="offset-md-2 col-2 text-center">
                @if($user->image == null || $user->image == '')
                    <a class="link text-dark" href="{{ route('users.show', $user->user_id) }}">
                    <i class="fas fa-user-circle fa-4x"></i>
                    </a>
                @else
                    <a class="link" href="{{ route('users.show', $user->user_id) }}">
                    <img class="resize-circle-show" src="https://mycloset-sakataran.s3-ap-northeast-1.amazonaws.com/{{ $user->image }}">
                    </a>
                @endif
            </div>
            <div class="offset-1 col-3">
                <div>
                    <p></p>
                    {{-- ニックネーム --}}
                    {{ $user->name }}
                </div>
            </div>
            <div class="col-3 mt-3">
                <div>
                    @include('commons.follow_button')
                </div>
            </div>
        </div>
        <hr>
        @endforeach
    </div>
    {{-- ページネーションのリンク --}}
    {{ $users->links() }}
@endif