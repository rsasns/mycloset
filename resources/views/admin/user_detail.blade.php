@extends('layouts.admin')

@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">
			<a href="{{ url('admin/user_list') }}">ユーザー一覧</a> &gt; ユーザー詳細
		</div>
		<div class="card-body">
			<ul class="list-group">
				<li class="list-group-item">ユーザID: {{ $user->user_id }}</li>
				<li class="list-group-item">名前: {{ $user->name }}</li>
				<li class="list-group-item">メール: {{ $user->email }}</li>
				<li class="list-group-item">紹介文: {{ $user->bio }}</li>
				<li class="list-group-item">作成日: {{ $user->created_at->format('Y/m/d H:i:s') }}</li>
				<li class="list-group-item">更新日: {{ $user->updated_at->format('Y/m/d H:i:s') }}</li>
			</ul>
			<div class="">
			{!! Form::model($user, ['route' => ['admin.edit', $user->id], 'method' => 'get']) !!}
                {!! Form::submit('このユーザを編集する', ['class' => 'btn btn-success mt-2']) !!}
            {!! Form::close() !!}
			</div>
			
			<div class="">
			{!! Form::model($user, ['route' => ['admin.destroy', $user->id], 'method' => 'delete', 'onclick' => 'return confirm("本当に削除しますか？");']) !!}
                {!! Form::submit('このユーザを削除する', ['class' => 'btn btn-danger mt-2']) !!}
            {!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@endsection