@extends('layouts.app')

@section('content')
<div class="container">
    <div class="header">
        <div class="nav-buttons">
            <a href="#" class="btn btn-primary">時間割</a>
            <a href="#" class="btn btn-primary">授業進捗</a>
            <a href="#" class="btn btn-primary">プロフィール設定</a>
            <a href="{{ route('logout') }}" class="btn btn-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
        </div>
    </div>

    <div class="content">
        <section class="banner-section">
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
        </section>

        <section class="news-section">
            <h2>お知らせ</h2>
            <ul class="news-list">
                @foreach($articles as $article)
                    <li class="news-item">
                        <span class="news-date">{{ $article->posted_date->format('Y年m月d日') }}</span>
                        <a href="{{ route('user.article', $article->id) }}" class="news-title">{{ $article->title }}</a>
                    </li>
                @endforeach
            </ul>
        </section>
    </div>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
@endsection