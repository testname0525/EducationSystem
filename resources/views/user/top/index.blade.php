@extends('layouts.app')

@section('content')
    <h1>Welcome to the Top Page</h1>

    @if(isset($banners) && $banners->isNotEmpty())
        <h2>Banners</h2>
        <ul>
            @foreach($banners as $banner)
                <li>{{ $banner->image }}</li>
            @endforeach
        </ul>
    @endif

    @if(isset($articles) && $articles->isNotEmpty())
        <h2>Latest Articles</h2>
        <ul>
            @foreach($articles as $article)
                <li>{{ $article->title }} - {{ $article->posted_date }}</li>
            @endforeach
        </ul>
    @endif
@endsection