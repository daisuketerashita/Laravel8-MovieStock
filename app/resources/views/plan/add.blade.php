@extends('layouts.app')

@section('content')
<h1 class='pagetitle'>観たい映画登録ページ</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row justify-content-center container">
    <div class="col-md-10">
      <form method='POST' action="{{ route('plan.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label>映画のタイトル</label>
                <input type='text' class='form-control' name='title' placeholder='タイトルを入力'>
              </div>

              <div class="form-group">
                <label for="file1">映画のサムネイル</label>
                <input type="file" id="file1" name='image' class="form-control-file">
              </div>
              <input type='submit' class='btn btn-primary' value='登録'>
              <a href="{{ route('plan.index') }}"  class='btn-back'>戻る</a>
            </div>
        </div>
      </form>
    </div>
</div>
@endsection