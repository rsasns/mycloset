@if (Auth::check())
    {!! link_to_route('cordinates.create', '投稿する', ['user' => Auth::user()->user_id], ['class' => 'btn btn-block btn-outline-color rounded-pill mb-2']) !!}
    <div class="none">
        <p class="lead"><i class="fab fa-hotjar mr-1 mt-3"></i>トレンドタグ</p>
        <hr>
        <div class="d-flex flex-wrap">
            @foreach( $hotTags as $tag )
                <form class="form-inline" action="{{ url('/search')}}" method="post">
                    {{ csrf_field()}}
                    {{method_field('get')}}
                    <button type="submit" class="btn btn-outline-secondary btn-sm" name="keyword" value="{{ $tag->tag }}">#{{ $tag->tag }}</button>
                </form>
            @endforeach
        </div>
    </div>
@endif