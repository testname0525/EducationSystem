@extends('layouts.app')

@section('content')
<div class="container">
    <div class="content">
        <section class="banner-section">
            @if(isset($banners) && $banners->isNotEmpty())
                <div id="banner-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach($banners as $index => $banner)
                            <li data-target="#banner-carousel" data-slide-to="{{ $index }}" @if($index == 0) class="active" @endif></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach($banners as $index => $banner)
                            <div class="carousel-item @if($index == 0) active @endif">
                                @if(isset($banner->image))
                                    <img src="{{ asset('storage/' . $banner->image) }}" class="d-block w-100" alt="Banner">
                                @else
                                    <div class="d-block w-100 bg-secondary" style="height: 200px;"></div>
                                @endif
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
            @else
                <p>バナーはありません。</p>
            @endif
        </section>
        <section class="news-section">
            <h2>お知らせ</h2>
            @if(isset($articles) && $articles->isNotEmpty())
                <ul class="news-list">
                    @foreach($articles as $article)
                        <li class="news-item">
                            <span class="news-date">
                                @if($article->posted_date)
                                    {{ $article->posted_date->format('Y年m月d日') }}
                                @else
                                    日付不明
                                @endif
                            </span>
                            <a href="{{ route('articles.show', $article->id) }}" class="news-title">{{ $article->title ?? '無題' }}</a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>お知らせはありません。</p>
            @endif
        </section>
    </div>
</div>
@endsection

@push('styles')
<style>
    .container {
        max-width: 100%;
        padding: 0;
    }
    .content {
        padding: 20px;
    }
    .banner-section {
        margin-bottom: 20px;
        position: relative;
    }
    .carousel-item img {
        width: 100%;
        height: auto;
    }
    .news-section {
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .news-list {
        list-style: none;
        padding: 0;
    }
    .news-item {
        margin-bottom: 10px;
        padding: 10px;
        background-color: #f9f9f9;
        border-radius: 5px;
    }
    .news-date {
        font-weight: bold;
        margin-right: 10px;
    }
    .news-title {
        color: #333;
        text-decoration: none;
    }
    .news-title:hover {
        text-decoration: underline;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var carousel = document.querySelector('#banner-carousel');
        if (carousel) {
            new bootstrap.Carousel(carousel, {
                interval: 5000
            });
        }
    });
</script>
@endpush