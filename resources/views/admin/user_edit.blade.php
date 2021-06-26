@extends('layouts.admin')

@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">
			<a href="{{ url('admin/user_list') }}">ユーザー一覧</a> &gt; ユーザー詳細
		</div>
		<div class="card-body">
			{!! Form::model($user, ['route' => ['admin.update', $user->id], 'method' => 'put']) !!}
			<ul class="list-group">
				<li class="list-group-item">ユーザID: {!! Form::text('user_id', null, ['class' => 'form-control']) !!}</li>
				<li class="list-group-item">名前: {!! Form::text('name', null, ['class' => 'form-control']) !!}</li>
				<li class="list-group-item">メール: {!! Form::text('mail', null, ['class' => 'form-control']) !!}</li>
				<li class="list-group-item">紹介文: {!! Form::text('bio', null, ['class' => 'form-control']) !!}</li>
				<li class="list-group-item">作成日: {{ $user->created_at->format('Y/m/d H:i:s') }}</li>
				<li class="list-group-item">更新日: {{ $user->updated_at->format('Y/m/d H:i:s') }}</li>
			</ul>
			<div class="">
                {!! Form::submit('変更を反映する', ['class' => 'btn btn-success mt-2']) !!}
            {!! Form::close() !!}
			</div>
			</div>
		</div>
	</div>
</div>
@endsection