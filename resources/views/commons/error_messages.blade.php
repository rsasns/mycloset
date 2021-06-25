@if (count($errors) > 0)
    <ul class="text-left alert alert-danger" role="alert">
        @foreach ($errors->all() as $error)
            <div class="ml-4"><i class="fas fa-exclamation-triangle mr-2"></i>{{ $error }}</div>
        @endforeach
    </ul>
@endif