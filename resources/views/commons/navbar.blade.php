<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-light fixed-top ">
        {{-- トップページへのリンク --}}
        <a class="logo navbar-brand" href="/">My closet</a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                {{-- マイページへのリンク --}}
                <li class="nav-item">{!! link_to_route('users.show', {{ Auth::user->user_id }}, ['user' => Auth::id()]) !!}</li>
                {{-- ログアウト --}}
                <li class="nav-item">{!! link_to_route('logout.get', 'ログアウト') !!}</li>
            </ul>
        </div>
    </nav>
</header>