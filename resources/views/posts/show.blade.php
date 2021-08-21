@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h1>一覧ページ</h1>
      <a href="{{ route('posts.create') }}" class="btn btn-primary">新規投稿</a>
      <div class="card text-center">
        <div class="card-header">
          Blogs
        </div>
        <div class="card-body">
          <h5 class="card-title">タイトル：{{ $post->title}}</h5>
          <p class="card-text">内容：{{$post->body}}</p>
          <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">編集画面へ</a>
        </div>
        <div class="card-footer text-muted">
          投稿日：
        </div>
      </div>
    </div>
  </div>
</div>
@endsection