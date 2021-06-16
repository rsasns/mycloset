@extends('layouts.app')

@section('content')
    @include('commons.navbar')
    <div class="container">
        @include('commons.error_messages')
        <div class="row">
            <div class ="col-md-12">
                {!! Form::open(['route' => ['cordinates.store'], 'enctype' => 'multipart/form-data']) !!}
                <label class="upload-label btn btn-outline-dark rounded-pill">
                    画像を選択する
                    {!! Form::file('image',['accept' => '.png, .jpeg, .jpg, .gif','class' => 'file']) !!}
                    {{ csrf_field() }}
                </label>
                <div>
                <img id="preview" width="200px">
                </div>
                <div class="form-group">
                    {!! Form::label('text', 'コーディネート説明', ['class' => 'col-form-label']) !!}
                    {!! Form::textarea('text', null, ['class' => 'form-control border border-dark', 'rows' => '3']) !!}
                </div>
            {!! Form::submit('投稿する', ['class' => 'btn btn-block btn-outline-color rounded-pill']) !!}
            </div>
        {!! Form::close() !!}
        </div>  
    </div>
@endsection