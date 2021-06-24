@extends('layouts.app')

@section('content')
  @include('commons.navbar')
  <div class="container">
  @include('commons.error_messages')
    <div class="row">
      <div class ="col-md-12">
        <a class="link text-dark" href="{{ route('cordinates.edit',$cordinate->id) }}"><i class="fas fa-arrow-left mr-2"></i>コーディネート編集画面へ戻る</a>
        <p></p>
        <img width="200px" src="https://mycloset-sakataran.s3-ap-northeast-1.amazonaws.com/{{ $cordinate->image }}">
        {!! Form::open(['id' => 'item','route' => ['items.store',$cordinate->id], 'method' => 'post', 'autocomplete'=> 'off']) !!}
        {!! Form::label('', '着用アイテム', ['class' => 'col-form-label mr-2']) !!}
        <div class="form-group">
            <div class="form-inline">
            {!! Form::label('category', 'カテゴリ', ['class' => 'col-form-label mr-2']) !!}
            {!! Form::select('category_id',$categoryList, null,  ['form' => 'item', 'id' => 'parent', 'class' => 'form-control border border-dark mr-3', 'placeholder' => '選択してください']) !!}
            {!! Form::select('sub_category_id',$subCategoryList, null,  ['form' => 'item', 'id' => 'children','class' => 'form-control border border-dark mr-3', 'placeholder' => '選択してください']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="form-inline">
            {!! Form::label('size_id', 'サイズ', ['class' => 'col-form-label mr-4']) !!}
            {!! Form::select('size_id',$sizeList, null,  ['form' => 'item', 'class' => 'form-control border border-dark mr-3', 'placeholder' => '選択してください']) !!}
            {!! Form::label('brand', 'ブランド', ['class' => 'col-form-label mr-2']) !!}
            {!! Form::text('brand', null,  ['form' => 'item', 'class' => 'form-control border border-dark mr-3', 'placeholder' => 'ブランドを入力']) !!}
            {!! Form::submit('追加する', ['class' => 'btn btn-outline-dark rounded-pill']) !!}
        {!! Form::close() !!}
            </div>
        </div>
        {!! Form::label('', '登録中のアイテム', ['class' => 'col-form-label mr-2']) !!}
        @if(count ($addItems) > 0)
          <table class="table table-sm">
          <thead>
            <tr>
              <tr>
              <th scope="col">カテゴリ</th>
              <th scope="col">サイズ</th>
              <th scope="col">ブランド</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
          @foreach($addItems as $addItem )
            <tr>
              <td>{{ $addItem->category_id }}>{{ $addItem->subcategory_id }}</th>
              <td>{{ $addItem->size_id }}</td>
              <td>{{ $addItem->brand_id }}</td>
              <td>
                {!! Form::model($addItem, ['route' => ['items.destroy',['id' => $cordinate->id , 'item' => $addItem->id]], 'method' => 'delete']) !!}
                  {!! Form::submit('削除する', ['class' => 'link text-secondary']) !!}
                {!! Form::close() !!}
              </td>
            </tr>
          @endforeach
          </tbody>
          </table>
        @else
        <div class="alert alert-secondary" role="alert">
        登録中のアイテムはありません
        </div>
        
        @endif
        <a class="btn btn-block btn-outline-color rounded-pill mb-2" href="{{ route('cordinates.show', $cordinate->id) }}">編集を完了する</a>
        
        <script>
            //アイテム登録のセレクトボックスの連動
         // 親カテゴリのselect要素が変更になるとイベントが発生
          $('#parent').change(function () {
            var cate_val = $(this).val();
        
            $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url: '/fetch/category',
              type: 'POST',
              data: {'category_val' : cate_val},
              datatype: 'json',
            })
            .done(function(data) {
              // 子カテゴリのoptionを一旦削除
              $('#children option').remove();
              // DBから受け取ったデータを子カテゴリのoptionにセット
              $.each(data, function(key, value) {
                $('#children').append($('<option>').text(value.subcategory).attr('value', key));
              })
            })
            .fail(function() {
              console.log('失敗');
            }); 
        
          });
        </script>
      </div>
    </div>
  </div>
@endsection