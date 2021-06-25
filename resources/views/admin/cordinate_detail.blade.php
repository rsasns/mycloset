@extends('layouts.admin')

@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">
			<a href="{{ url('admin/cordinate_list') }}">コーディネート一覧</a> &gt; コーディネート詳細
		</div>
		<div class="card-body">
			<ul class="list-group">
				<li class="list-group-item">ユーザID: {{ $cordinate->user->user_id }}</li>
				<li class="list-group-item">作成日: {{ $cordinate->user->created_at->format('Y/m/d H:i:s') }}</li>
				<li class="list-group-item">更新日: {{ $cordinate->user->updated_at->format('Y/m/d H:i:s') }}</li>
				<li class="list-group-item">画像: <img class="resize" src="https://mycloset-sakataran.s3-ap-northeast-1.amazonaws.com/{{ $cordinate->image }}"></li>
				<li class="list-group-item">本文: {{ $cordinate->text }}</li
			</ul>
			<div class="">
			{!! Form::model($cordinate, ['route' => ['admin.cordinateDestroy', $cordinate->id], 'method' => 'delete', 'onclick' => 'return confirm("本当に削除しますか？");']) !!}
                {!! Form::submit('このコーディネートを削除する', ['class' => 'btn btn-danger mt-2']) !!}
            {!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@endsection