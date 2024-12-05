@extends('admin.layouts.app')

@section('content')
<!-- 戻るボタン -->
<a href="{{ route('admin.show.article.list') }}" class="btn btn-link" style="background: transparent; color: black; border: none;">
        ← 戻る
</a>
<div class="container">
    <h2>お知らせ新規登録</h2>

    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.show.article.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="posted_date">投稿日時</label>
            <input type="date" class="form-control" id="posted_date" name="posted_date" required>
        </div>

        <div class="form-group">
            <label for="title">タイトル</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="form-group">
            <label for="article_contents">本文</label>
            <textarea class="form-control" id="article_contents" name="article_contents" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">登録</button>
    </form>
</div>
@endsection
