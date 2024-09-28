@extends('layouts.app')

@section('content')
<div class="container">
    <h2>配信コンテンツ</h2>
    @foreach($curriculums as $curriculum)
        <div class="curriculum-item">
            <h3>{{ $curriculum->title }}</h3>
            <p>{{ $curriculum->description }}</p>
            <a href="{{ route('user.delivery.show', $curriculum->id) }}" class="btn">詳細を見る</a>
        </div>
    @endforeach
</div>
@endsection