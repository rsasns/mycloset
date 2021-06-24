@extends('layouts.app')

@section('content')
    @include('commons.navbar')
    <div class="container">
        @include('commons.error_messages')
        <div class="row">
            <div class ="col-md-12">
                <label class="upload-label btn btn-outline-dark rounded-pill">
                    画像を選択する
                    {!! Form::file('image',['accept' => '.png, .jpeg, .jpg, .gif','class' => 'file', 'form' => 'cordinate']) !!}
                    {{ csrf_field() }}
                </label>
                <div>
                <img id="preview" width="200px">
                </div>
                <div class="form-group">
                    {!! Form::label('text', 'コーディネート説明', ['class' => 'col-form-label']) !!}
                    {!! Form::textarea('text', null, ['class' => 'form-control border border-dark', 'rows' => '3', 'form' => 'cordinate']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('tags', 'タグ', ['class' => 'col-form-label']) !!}
                    {!! Form::text('tags', null, ['class' => 'form-control border border-dark','placeholder' => '#tag#tag#tag', 'form' => 'cordinate']) !!}
                </div>
                
            {!! Form::open(['id' => 'cordinate','route' => ['cordinates.store'], 'enctype' => 'multipart/form-data', 'autocomplete'=> 'off']) !!}
                {!! Form::hidden('id', $cordinate->id, ['form' => 'cordinate']) !!}
                {!! Form::submit('着用アイテムを追加する', ['class' => 'btn btn-block btn-outline-color rounded-pill', 'method' => 'post']) !!}
            {!! Form::close() !!}
            </div>
        </div>  
    </div>
@endsection