@extends('layouts.app')

@section('content')
    @include('commons.navbar')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img class="resize mb-2" src="https://mycloset-sakataran.s3-ap-northeast-1.amazonaws.com/{{ $cordinate->image }}">
                <div class="row mb-2">
                    <div class="mb-2">
                        <div class="col-md-12">
                            @include('commons.nice_button')
                            @include('commons.clip_button')
                        </div>
                    </div>
            </div>
                </div>
            <div class="col-md-6">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="d-flex  justify-content-between">
                            <div class="media">
                                @if($cordinate->user->image == null || $cordinate->user->image == '')
                                    <a class="link text-dark" href="{{ route('users.show', $cordinate->user->user_id) }}">
                                    <i class="fas fa-user-circle fa-4x"></i>
                                    </a>
                                @else
                                    <a class="link" href="{{ route('users.show', $cordinate->user->user_id) }}">
                                    <img class="resize-circle-show mr-3" src="https://mycloset-sakataran.s3-ap-northeast-1.amazonaws.com/{{ $cordinate->user->image }}">
                                    </a>
                                @endif
                                <div class="media-body">
                                    <h5 class="mt-0">{{ $cordinate->user->name }}</h5>
                                    @if ($cordinate->userheight_hidden != 1 && $cordinate->user->height !== null)
                                        <span class="mr-1">{{ $cordinate->user->height }}cm</span>
                                    @endif
                                    @if ($cordinate->user->sex_hidden != 1 && $cordinate->user->sex !== null)
                                        @if ($cordinate->user->sex == 0 )
                                            <span class="mr-1">MEN</span>
                                        @else
                                            <span class="mr-1">WOMEN</span>
                                        @endif
                                    @endif
                                    @if ($cordinate->user->age_hidden != 1 && $cordinate->user->age !== null)
                                        <span>age{{ $cordinate->user->age }}</span>
                                    @endif
                                </div>
                            </div>
                            @if (Auth::id() == $cordinate->user_id)
                            <div class="dropdown">
                              <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('cordinates.edit', $cordinate->id) }}">この投稿を編集する</a>
                                    <div class="dropdown-divider"></div>
                                    {!! Form::model($cordinate, ['route' => ['cordinates.destroy', $cordinate->id], 'method' => 'delete', 'onclick' => 'return confirm("本当に削除しますか？");']) !!}
                                        {!! Form::submit('この投稿を削除する', ['class' => 'dropdown-item']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            @endif
                        </div>
                            <hr>
                            <div class="mb-2">
                                {!! nl2br($cordinate->text) !!}
                                <div class="text-secondary">Posted by {{ $cordinate->created_at }}</div>
                            </div>
                            <div>
                                <button type="button" class="btn btn-outline-secondary btn-sm">#tag</button>
                                <button type="button" class="btn btn-outline-secondary btn-sm">#tag</button>
                                <button type="button" class="btn btn-outline-secondary btn-sm">#tag</button>
                            </div>
                        </div>
                    </div>    
                <div class="row bg-light">
                    <div class="col-md-12">
                        <h6>着用アイテム</h6>
                    </div>
                    <div class="col-md-12">
                        <span>大カテゴリ　＞　中カテゴリ　＞　小カテゴリ</span>
                        <p></p>
                        <span>ブランド名</span><span>サイズ</span>
                        <p></p>
                    </div>
                </div>
            </div>
            </div>
        @include('comments.index')
        </div>
    </div>
@endsection