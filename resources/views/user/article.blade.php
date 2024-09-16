@extends('user.layouts.app')

@section('content')
<!-- 戻るボタン -->
<a href="{{ route('user.show.article.list') }}" class="btn btn-link" style="background: transparent; color: black; border: none;">
        ← 戻る
</a>
<!-- お知らせ詳細 -->
<div class="container my-4">
    <h3 class="mb-3">{{ $article->posted_date->format('Y-m-d') }}</h3>
    <h2 class="mb-4">{{ $article->title }}</h2>
    <div class="border p-4 bg-light">
        <p>{{ $article->article_contents }}</p>
    </div>
</div>
@endsection
