@extends('admin.layouts.app')

@section('content')
<!-- 戻るボタン -->
<a href="{{ route('admin.show.article.list') }}" class="btn btn-link" style="background: transparent; color: black; border: none;">
        ← 戻る
</a>
<div class="container">
    <h2>お知らせ編集</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.update.article', $article->id) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="posted_date">投稿日時</label>
            <input type="date" class="form-control" id="posted_date" name="posted_date" value="{{ old('posted_date', $article->posted_date->format('Y-m-d')) }}" required>
        </div>

        <div class="form-group">
            <label for="title">タイトル</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $article->title }}" required>
        </div>

        <div class="form-group">
            <label for="article_contents">本文</label>
            <textarea class="form-control" id="article_contents" name="article_contents" rows="5" required>{{ $article->article_contents }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">更新</button>
    </form>
</div>
@endsection
