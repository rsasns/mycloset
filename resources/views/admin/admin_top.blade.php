@extends('layouts.admin')

@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">管理側TOP</div>
		<div class="card-body">
			<div>
				<a href="{{ url('admin/user_list') }}" class="btn btn-primary mb-2">ユーザー一覧</a>
			</div>
			<div>
				<a href="{{ url('admin/cordinate_list') }}" class="btn btn-primary mb-2">コーディネート一覧</a>
			</div>
			<div>
				<a href="{{ url('admin/brand_list') }}" class="btn btn-primary mb-2">ブランド一覧</a>
			</div>
			<form method="post" action="{{ url('admin/logout') }}">
				@csrf
				<input type="submit" class="btn btn-danger" value="ログアウト" />
			</form>
		</div>
	</div>
</div>
@endsection