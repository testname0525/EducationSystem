@extends('layouts.app')

@section('content')
<div class="container">
    <div class="header">
        <a href="{{ route('user.top') }}" class="btn btn-link">←戻る</a>
        <div class="nav-buttons">
            <a href="#" class="btn btn-primary">時間割</a>
            <a href="#" class="btn btn-primary">授業進捗</a>
            <a href="#" class="btn btn-primary">プロフィール設定</a>
            <a href="{{ route('logout') }}" class="btn btn-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
        </div>
    </div>

    <div class="content">
        <div class="video-container">
            @if($canViewVideo && $curriculum->video_url)
                <video src="{{ $curriculum->video_url }}" controls></video>
            @else
                <p>この動画は現在表示できません。</p>
            @endif
        </div>

        <div class="curriculum-info">
            <span class="grade-label">{{ $curriculum->grade->name }}</span>
            <span class="curriculum-number">{{ $curriculum->id }}</span>
            <h1 class="curriculum-title">{{ $curriculum->title }}</h1>
            <p class="curriculum-description">{{ $curriculum->description }}</p>
            <div class="curriculum-content">
                {!! $curriculum->content !!}
            </div>
        </div>

        @if($canPressButton)
            <button id="completeButton" class="btn btn-primary">受講しました</button>
        @else
            <button class="btn btn-secondary" disabled>受講済み</button>
        @endif
    </div>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<script>
document.getElementById('completeButton')?.addEventListener('click', function() {
    fetch('{{ route("user.delivery.updateProgress", $curriculum->id) }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({})
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            alert('進捗が更新されました。');
            this.disabled = true;
            this.textContent = '受講済み';
            this.className = 'btn btn-secondary';
        }
    })
    .catch((error) => {
        console.error('Error:', error);
    });
});
</script>
@endsection