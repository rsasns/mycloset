<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>My closet　管理者画面</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" type="text/css" href="/style.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="{{ asset('/js/hoge.js') }}"></script>
        <script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
    </head>

    <body>
        <header class="mb-4">
            <nav class="navbar navbar-expand-sm navbar-light bg-light fixed-top">
                {{-- トップページへのリンク --}}
                <a class="logo navbar-brand" href="{{ url('admin') }}"><i class="fas fa-hashtag color mr-2"></i>My closet 管理者画面</a>
            </nav>
        </header>
        @yield('content')
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    </body>
</html>