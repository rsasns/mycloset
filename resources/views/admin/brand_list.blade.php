@extends('layouts.admin')

@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">ブランド一覧</div>
		<div class="card-body">
			<ul class="list-group">
				@foreach ($brand_list as $brand)
				<li class="list-group-item">
					{{ $brand->brand }}
				</li>
				@endforeach
			</ul>
			<div class="mt-3">
				{{ $brand_list->links() }}
			</div>
        </div>
    </div>
		</div>
	</div>
</div>
@endsection