@extends('layouts.app')

@section('content')
<div class="banner-container">
    @if(isset($banners) && $banners->isNotEmpty())
        <div id="banner-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach($banners as $banner)
                    <div class="carousel-item @if($loop->first) active @endif">
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
        <div class="banner-nav">
            @foreach($banners as $index => $banner)
                <span class="banner-dot" data-target="#banner-carousel" data-slide-to="{{ $index }}"></span>
            @endforeach
        </div>
    @endif
</div>

<div class="articles">
    <h3>お知らせ</h3>
    @if(isset($articles) && $articles->isNotEmpty())
        <ul>
            @foreach($articles as $article)
                <li>
                    <span>{{ $article->posted_date->format('Y年m月d日') }}</span>
                    <a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a>
                </li>
            @endforeach
        </ul>
    @else
        <p>お知らせはありません。</p>
    @endif
</div>
@endsection

@push('styles')
<style>
    .banner-container {
        margin-bottom: 20px;
        position: relative;
    }
    .carousel-item img {
        width: 100%;
        height: auto;
    }
    .banner-nav {
        position: absolute;
        bottom: 10px;
        left: 0;
        right: 0;
        text-align: center;
    }
    .banner-dot {
        display: inline-block;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: #ccc;
        margin: 0 5px;
        cursor: pointer;
    }
    .banner-dot.active {
        background-color: #333;
    }
    .articles {
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .articles ul {
        list-style: none;
        padding: 0;
    }
    .articles li {
        margin-bottom: 10px;
        padding: 10px;
        background-color: #f9f9f9;
        border-radius: 5px;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        $('#banner-carousel').carousel({
            interval: 5000
        });

        $('.banner-dot').click(function() {
            var slideIndex = $(this).data('slide-to');
            $('#banner-carousel').carousel(slideIndex);
        });

        $('#banner-carousel').on('slide.bs.carousel', function (e) {
            var slideIndex = $(e.relatedTarget).index();
            $('.banner-dot').removeClass('active');
            $('.banner-dot[data-slide-to="' + slideIndex + '"]').addClass('active');
        });
    });
</script>
@endpush