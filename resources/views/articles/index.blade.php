@extends('layouts.app')

@section('content')
<div class="container">
    <h1>お知らせ一覧</h1>
    @foreach($articles as $article)
        <article>
            <h2>{{ $article->title }}</h2>
            <p>投稿日: {{ $article->posted_date->format('Y-m-d') }}</p>
            <a href="{{ route('articles.show', $article) }}">詳細を見る</a>
        </article>
    @endforeach

    {{ $articles->links() }}
</div>
@endsection