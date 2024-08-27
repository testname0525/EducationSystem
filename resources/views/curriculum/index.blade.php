@extends('layouts.app')

@section('content')
<div class="container">
    <h1>カリキュラム一覧</h1>
    @foreach($curriculums as $curriculum)
        <div>
            <h2>{{ $curriculum->title }}</h2>
            <p>{{ $curriculum->description }}</p>
            <p>学年: {{ $curriculum->grade->name }}</p>
            <video src="{{ asset('storage/' . $curriculum->video_url) }}" controls></video>
            <form action="{{ route('curriculum.updateProgress', $curriculum) }}" method="POST">
                @csrf
                <input type="hidden" name="clear_flg" value="{{ $curriculum->progress->first()->clear_flg ? 0 : 1 }}">
                <button type="submit">
                    {{ $curriculum->progress->first()->clear_flg ? '未クリアに戻す' : 'クリアにする' }}
                </button>
            </form>
        </div>
    @endforeach
</div>
@endsection