@if (Auth::check())
    @extends('layouts.app')

    @section('content')
        @include('commons.navbar')
        <div class="container">
            {{-- 検索フォーム --}}
            <p class="lead">コーディネートを探す</p>
            <hr>
            {{Form::open(['url' => '/search', 'method' => 'GET'])}}
            <div class="form-group row">
                {!! Form::label('sex', '性別', ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-4">
                    <div class="form-check form-check-inline">
                        {!! Form::radio('sex', 2, null, ['class' => 'form-check-input', 'id' => 'all']) !!}
                        {!! Form::label('all', 'All') !!}
                    </div>
                    <div class="form-check form-check-inline">
                        {!! Form::radio('sex', 0, null, ['class' => 'form-check-input', 'id' => 'men']) !!}
                        {!! Form::label('men', 'MEN') !!}
                    </div>
                    <div class="form-check form-check-inline">
                        {!! Form::radio('sex', 1, null, ['class' => 'form-check-input', 'id' => 'women']) !!}
                        {!! Form::label('women', 'WOMEN') !!}
                    </div>
                </div>
            </div>
            <div class="row">
                    <div class="col-md-6">
                        {!! Form::submit('検索する', ['class' => 'btn btn-block btn-outline-color rounded-pill']) !!}
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    @endsection
@else
    @include('auth.login')
@endif