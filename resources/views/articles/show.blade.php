@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $article->title }}</h1>
    <p>投稿日: {{ $article->posted_date->format('Y-m-d') }}</p>
    <div>
        {!! $article->content !!}
    </div>
    <a href="{{ route('articles.index') }}">一覧に戻る</a>
</div>
@endsection