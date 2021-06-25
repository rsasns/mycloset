@extends('layouts.admin')

@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">コーディネート一覧</div>
		<div class="card-body">
			<ul class="list-group">
				@foreach ($cordinate_list as $cordinate)
				<li class="list-group-item">
					{{ $cordinate->created_at }}
					<a href="{{ url('admin/cordinate/' . $cordinate->id) }}">
						{{ $cordinate->user->name }}
					</a>
				</li>
				@endforeach
			</ul>
			<div class="mt-3">
				{{ $cordinate_list->links() }}
			</div>
        </div>
    </div>
		</div>
	</div>
</div>
@endsection