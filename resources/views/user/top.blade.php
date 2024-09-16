@extends('user.layouts.app')

@section('content')
<!-- バナー -->
    <section class="bg-light text-center py-5">
        <div class="container">
            <h1>バナー画像</h1>
        </div>
    </section>

    <!-- お知らせ -->
        <div class="container">
            <h2 class="mb-4">お知らせ</h2>
            <div>
                <div>
                    @forelse($articles as $article)
                        <a href="{{ route('user.show.article', $article->id) }}" class="text-decoration-none text-dark">
                            <div class="d-flex justify-content-between align-items-center mb-3 p-3 border rounded">
                                <div class="d-flex flex-grow-1">
                                    <span class="me-4">{{ $article->posted_date->format('Y-m-d') }}</span>
                                    <span class="ml-4">{{ $article->title }}</span>
                                </div>
                            </div>
                        </a>
                    @empty
                        <p>お知らせはありません。</p>
                    @endforelse
                </div>
            </div>
        </div>
@endsection