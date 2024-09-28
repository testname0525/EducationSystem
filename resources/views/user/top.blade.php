@extends('layouts.app')

@section('content')
<div class="container">
    <div class="banner-container">
        <img src="path_to_banner_image" alt="バナー画像">
        <div class="banner-nav">
            <span class="banner-dot"></span>
            <span class="banner-dot"></span>
            <span class="banner-dot"></span>
            <span class="banner-dot"></span>
        </div>
    </div>

    <div class="articles">
        <h3>お知らせ</h3>
        <ul>
            @foreach($articles as $article)
                <li>
                    <span>{{ $article->posted_date->format('Y年m月d日') }}</span>
                    <a href="{{ route('user.article', $article->id) }}">{{ $article->title }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection