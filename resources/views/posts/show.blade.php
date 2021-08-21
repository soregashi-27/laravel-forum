@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card-header">
        <h5>タイトル：{{ $post->title }}</h5>
      </div>
      <div class="card-body">
        <p class="card-text">内容：{{ $post->body }}</p>
        <p>投稿日時：</p>
      </div>
    </div>
  </div>
</div>
@endsection