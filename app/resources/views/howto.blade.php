@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/howto.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="howto-container">
    <div class="howto-innner">
        <h2>①『追加する』ボタンを押す</h2>
        <img src="{{ asset('images/howto01.png') }}" alt="">
        <h2>②『タイトル』『鑑賞日』『サムネイル』『星評価』を入力する</h2>
        <img src="{{ asset('images/howto02.png') }}" alt="">
    </div><!-- howto-innner -->
    <a href="{{ route('index') }}" class='btn btn-info btn-back'>さっそく使ってみる</a>
</div><!-- howto-container -->
@endsection 