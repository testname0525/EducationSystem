@extends('layouts.app')

@section('content')
<div class="container">
    <div class="header">
        <div class="nav-buttons">
            <a href="{{ route('user.timetable') }}" class="btn btn-primary">時間割</a>
            <a href="{{ route('user.progress') }}" class="btn btn-primary">授業進捗</a>
            <a href="{{ route('user.profile') }}" class="btn btn-primary">プロフィール設定</a>
            <a href="{{ route('logout') }}" class="btn btn-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
        </div>
    </div>

    <div class="content">
        <section class="banner-section">
            @if(isset($banners) && $banners->isNotEmpty())
                <div id="banner-carousel" class="carousel slide" data-bs-ride="carousel">
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
                    <button class="carousel-control-prev" type="button" data-bs-target="#banner-carousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#banner-carousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div class="banner-nav">
                    @foreach($banners as $index => $banner)
                        <span class="banner-dot @if($index == 0) active @endif" data-bs-target="#banner-carousel" data-bs-slide-to="{{ $index }}"></span>
                    @endforeach
                </div>
            @endif
        </section>

        <section class="news-section">
            <h2>お知らせ</h2>
            @if(isset($articles) && $articles->isNotEmpty())
                <ul class="news-list">
                    @foreach($articles as $article)
                        <li class="news-item">
                            <span class="news-date">{{ $article->posted_date->format('Y年m月d日') }}</span>
                            <span class="news-title">{{ $article->title }}</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>お知らせはありません。</p>
            @endif
        </section>
    </div>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

@push('styles')
<style>
    .container {
        max-width: 100%;
        padding: 0;
    }
    .header {
        background-color: #e57373;
        padding: 10px;
    }
    .nav-buttons {
        display: flex;
        justify-content: flex-end;
    }
    .nav-buttons .btn {
        margin-left: 10px;
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
        object-fit: cover;
    }
    .banner-nav {
        position: absolute;
        bottom: 10px;
        left: 0;
        right: 0;
        text-align: center;
        z-index: 2;
    }
    .banner-dot {
        display: inline-block;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.5);
        margin: 0 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .banner-dot.active {
        background-color: #fff;
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
        margin: 0;
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
        color: #666;
    }
    .news-title {
        color: #333;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var carousel = new bootstrap.Carousel(document.querySelector('#banner-carousel'), {
        interval: 5000,
        wrap: true
    });

    document.querySelectorAll('.banner-dot').forEach(function(dot) {
        dot.addEventListener('click', function() {
            var slideIndex = this.getAttribute('data-bs-slide-to');
            carousel.to(parseInt(slideIndex));
        });
    });

    document.querySelector('#banner-carousel').addEventListener('slide.bs.carousel', function(e) {
        document.querySelectorAll('.banner-dot').forEach(function(dot) {
            dot.classList.remove('active');
        });
        document.querySelector('.banner-dot[data-bs-slide-to="' + e.to + '"]').classList.add('active');
    });
});
</script>
@endpush
@endsection