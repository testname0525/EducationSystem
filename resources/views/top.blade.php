@extends('layouts.app')

@section('content')
<div class="container">
    <h1>トップページ</h1>
    
    <section>
        <h2>バナー</h2>
        @foreach($banners as $banner)
            <img src="{{ asset('storage/' . $banner->image) }}" alt="バナー">
        @endforeach
    </section>

    <section>
        <h2>最新のお知らせ</h2>
        @foreach($articles as $article)
            <article>
                <h3>{{ $article->title }}</h3>
                <p>投稿日: {{ $article->posted_date->format('Y-m-d') }}</p>
                <a href="{{ route('articles.show', $article) }}">詳細を見る</a>
            </article>
        @endforeach
    </section>
</div>
@endsection