@extends('layouts.app')

@section('content')
<div class="outer">
    <div class="inner center jumbotron">
        <div class="text-center">
            <h1 class="logo mb-4"><i class="fas fa-hashtag color mr-2"></i>My closet</h1>
            
            <p>以下のURLをクリックし、パスワードの再設定を行って下さい。</p>
            <p><a class="link" href='{{ $restUrl }}'>{{ $restUrl }}</a></p>
        </div>
    </div>
</div
@endsection