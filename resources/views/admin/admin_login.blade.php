@extends('layouts.admin')

@section('content')
<div class="outer">
    <div class="inner center jumbotron">
        <div class="text-center">
            <h1 class="logo mb-4"><i class="fas fa-hashtag color mr-2"></i>My closet</h1>
            <h5 class ="mb-4">管理者画面</h5>
			@include('commons.error_messages')

			<form method="post" action="{{ url('admin/login') }}">
			@csrf 
			<div class="form-group">
				<input class="form-control" type="text" name="user_id" value="" placeholder="ログインID"/>
			</div>
			<div class="form-group">
			    <input class="form-control" type="password" name="password" value="" placeholder="パスワード"/>
			</div>
			<div class="mt-3">
				<input class="btn btn-dark btn-block rounded-pill" type="submit" value="ログイン" />
			</div>
			</form>
        </div>
    </div>
</div
@endsection