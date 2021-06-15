@if (count($users) > 0)
    <ul class="list-unstyled">
        @foreach ($users as $user)
            <li class="media">
                {{-- プロフィール画像（仮） --}}
                <i class="fas fa-user-circle"></i>
                <div class="media-body">
                    <div>
                        {{-- ユーザID --}}
                        {!! link_to_route('users.show',{{ $user->user_id }}, ['user' => $user->id]) !!}
                    </div>
                    <div>
                        {{-- フォロワー数 --}}
                        <p>xxxフォロワー</p>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $users->links() }}
@endif