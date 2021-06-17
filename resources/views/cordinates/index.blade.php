@if (count($cordinates) > 0 )
    <h1 class="d-block mb-0">#NEW</h1>
    <div class="d-flex row">
        @foreach ($cordinates as $cordinate)
        <div class="col-md-4 p-2 text-wrap">
            <div class="card">
                <div class="card-header media">
                    <div class="m-1">
                        <a class="link" href="{{ route('users.show', $cordinate->user->user_id) }}">
                            <img class="resize-circle-index" src="https://mycloset-sakataran.s3-ap-northeast-1.amazonaws.com/{{ $cordinate->user->image }}">
                        </a>
                    </div>
                    <div class="media-body">
                        <div class="row">
                            <div class="col">
                                <a class="link text-dark" href="{{ route('users.show', $cordinate->user->user_id) }}">
                                    <h5 class="font-weigth-bold mb-0">
                                    {{ $cordinate->user->user_id}}
                                    </h5>
                                </a>
                                <small class="text-secondary">{{ $cordinate->user->height }}cm</small>
                            </div>
                            <div class="col text-right m-1">
                                <button type="button" class="btn btn-sm rounded-pill btn-outline-dark">フォロー</button>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="link" href="{{ route('cordinates.show', $cordinate->id) }}">
                    <img class="card-img resize" src="https://mycloset-sakataran.s3-ap-northeast-1.amazonaws.com/{{ $cordinate->image }}">
                </a>
            </div>
        </div>
        @endforeach
    </div>
@endif