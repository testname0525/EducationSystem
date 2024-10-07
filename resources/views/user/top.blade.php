@extends('layouts.app')

@section('content')
<div class="container">
    <div class="banner-container">
        @if(count($banners) > 0)
            <div id="banner-carousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach($banners as $index => $banner)
                        <li data-target="#banner-carousel" data-slide-to="{{ $index }}" @if($index == 0) class="active" @endif></li>
                    @endforeach
                </ol>
                <div class="carousel-inner">
                    @foreach($banners as $index => $banner)
                        <div class="carousel-item @if($index == 0) active @endif">
                            <img src="{{ asset('storage/' . $banner->image) }}" class="d-block w-100" alt="Banner">
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#banner-carousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#banner-carousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        @endif
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

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">ログアウト</button>
    </form>
</div>
@endsection