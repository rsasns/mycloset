@extends('layouts.app')

@section('content')
    @include('commons.navbar')
    <div class="container">
            @include('commons.error_messages')
        <div class="row">
            <div class="col-md-4 text-center">
               @if($user->image == null || $user->image == '')
                    <i class="fas fa-user-circle fa-9x"></i>
                @else
                    <img class="resize-circle" src="https://mycloset-sakataran.s3.ap-northeast-1.amazonaws.com/{{ $user->image }}">
                @endif
            </div>
            <div class="col-md-8">
                <h3>{{ $user->user_id }}</h3>
                <p></p>
                {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put',  'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group">
                        <label class="upload-label btn btn-outline-dark rounded-pill">
                            プロフィール画像を変更する
                            {!! Form::file('image',['accept' => '.png, .jpeg, .jpg, .gif','class' => 'file']) !!}
                            {{ csrf_field() }}
                        </label>
                    </div>
            </div>
        </div>
        <p></p>
        <div class="form-group row">
            {!! Form::label('name', 'ニックネーム', ['class' => 'offset-md-1 col-md-2 col-form-label']) !!}
            <div class="col-md-4">
                {!! Form::text('name', null, ['class' => 'form-control border border-dark']) !!}
            </div>
        </div>
        <div class="form-group row">
            {!! Form::label('bio', '自己紹介', ['class' => 'offset-md-1 col-md-2 col-form-label']) !!}
            <div class="col-md-6">
                {!! Form::textarea('bio', null, ['class' => 'form-control border border-dark', 'rows' => '3']) !!}
            </div>
        </div>
        <div class="form-group row">
            {!! Form::label('height', '身長(cm)', ['class' => 'offset-md-1 col-md-2 col-form-label']) !!}
            <div class="col-md-2">
                {!! Form::text('height', null, ['class' => 'form-control border border-dark']) !!}
            </div>
            <div class="col-md-7 form-check">
                {!! Form::checkbox('height_hidden', 1, $user->height_hidden, ['class' => 'form-check-input']) !!}
                {!! Form::label('height_hidden', '非公開にする', ['class' => 'form-check-label']) !!}
            </div>
        </div>
        <div class="form-group row">
            {!! Form::label('sex', '性別', ['class' => 'offset-md-1 col-md-2 col-form-label']) !!}
            <div class="col-md-2">
                <div class="form-check form-check-inline">
                    {!! Form::radio('sex', 1, null, ['class' => 'form-check-input', 'id' => 'men']) !!}
                    {!! Form::label('men', 'MEN') !!}
                </div>
                <div class="form-check form-check-inline">
                    {!! Form::radio('sex', 2, null, ['class' => 'form-check-input', 'id' => 'women']) !!}
                    {!! Form::label('women', 'WOMEN') !!}
                </div>
            </div>
            <div class="col-md-7 form-check">
                {!! Form::checkbox('sex_hidden', 1, $user->sex_hidden, ['class' => 'border border-dark form-check-input']) !!}
                {!! Form::label('sex_hidden', '非公開にする', ['class' => 'form-check-label']) !!}
            </div>
        </div>
        <div class="form-group row">
            {!! Form::label('age', '年齢', ['class' => 'offset-md-1 col-md-2 col-form-label']) !!}
            <div class="col-md-2">
                {!! Form::text('age', null, ['class' => 'form-control border border-dark']) !!}
            </div>
            <div class="col-md-7 form-check">
                {!! Form::checkbox('age_hidden', 1, $user->age_hidden, ['class' => 'form-check-input']) !!}
                {!! Form::label('age_hidden', '非公開にする', ['class' => 'form-check-label']) !!}
            </div>
        </div>
        <div class="form-group row">
            {!! Form::label('homepage', 'URL', ['class' => 'offset-md-1 col-md-2 col-form-label']) !!}
            <div class="col-md-6">
                {!! Form::text('homepage', null, ['class' => 'form-control border border-dark', 'placeholder' => 'http://']) !!}
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-md-1 col-md-2">
                <p>SNS</p>
            </div>
                {!! Form::label('instagram', 'instagram ID', ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-4">
                    {!! Form::text('instagram', null, ['class' => 'form-control border border-dark']) !!}
                </div>
        </div>
        <div class="form-group row">
            {!! Form::label('twitter', 'twitter ID', ['class' => 'offset-md-3 col-md-2 col-form-label']) !!}
            <div class="col-md-4">
                {!! Form::text('twitter', null, ['class' => 'form-control border border-dark']) !!}
            </div>
        </div>
        <div class="form-group row">
            {!! Form::label('facebook', 'facebook ID', ['class' => 'offset-md-3 col-md-2 col-form-label']) !!}
            <div class="col-md-4">
                {!! Form::text('facebook', null, ['class' => 'form-control border border-dark']) !!}
            </div>
        </div>
        <div class="row">
            <div class="offset-md-1 col-md-8">
                {!! Form::submit('変更を反映する', ['class' => 'btn btn-block btn-outline-color rounded-pill']) !!}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <p></p>
@endsection