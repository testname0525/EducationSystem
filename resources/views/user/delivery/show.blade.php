@extends('layouts.app')

@section('content')
<div class="container">
    <div class="header">
        <a href="{{ route('user.delivery') }}" class="btn btn-link">←戻る</a>
        <div class="nav-buttons">
            <a href="{{ route('user.timetable') }}" class="btn btn-primary">時間割</a>
            <a href="{{ route('user.progress') }}" class="btn btn-primary">授業進捗</a>
            <a href="{{ route('user.profile') }}" class="btn btn-primary">プロフィール設定</a>
            <a href="{{ route('logout') }}" class="btn btn-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
        </div>
    </div>

    <div class="content">
        <div class="curriculum-info">
            <span class="grade-label">{{ $curriculum->grade->name }}</span>
            <span class="curriculum-number">{{ $curriculum->id }}</span>
            <h1 class="curriculum-title">{{ $curriculum->title }}</h1>
            <p class="curriculum-description">{{ $curriculum->description }}</p>
        </div>

        <div class="video-section">
            @if($canViewVideo && $curriculum->video_url)
                <div class="video-container">
                    <video src="{{ $curriculum->video_url }}" controls></video>
                </div>
            @else
                <div class="notice-box">
                    <p>この動画は現在表示できません。</p>
                    @if(!$curriculum->always_delivery_flg)
                        <p>配信期間をご確認ください。</p>
                    @endif
                </div>
            @endif
        </div>

        <div class="curriculum-content">
            {!! $curriculum->content !!}
        </div>

        <div class="action-section">
            @if($canPressButton)
                <button id="completeButton" class="btn btn-primary">受講しました</button>
            @else
                <button class="btn btn-secondary" disabled>受講済み</button>
            @endif
        </div>
    </div>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

@push('styles')
<style>
    .container {
        max-width: 100%;
        padding: 20px;
    }
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    .nav-buttons {
        display: flex;
        gap: 10px;
    }
    .curriculum-info {
        margin-bottom: 20px;
    }
    .grade-label {
        background-color: #e9ecef;
        padding: 5px 10px;
        border-radius: 4px;
        margin-right: 10px;
    }
    .curriculum-number {
        color: #666;
    }
    .video-section {
        margin-bottom: 20px;
    }
    .video-container {
        position: relative;
        padding-bottom: 56.25%;
        height: 0;
        overflow: hidden;
    }
    .video-container video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
    .notice-box {
        background-color: #f8f9fa;
        padding: 20px;
        text-align: center;
        border-radius: 4px;
        margin: 20px 0;
    }
    .curriculum-content {
        margin-bottom: 20px;
    }
    .action-section {
        text-align: center;
        margin-top: 20px;
    }
</style>
@endpush

@push('scripts')
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
            this.className = 'btn btn-secondary';
            this.textContent = '受講済み';
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('エラーが発生しました。もう一度お試しください。');
    });
});
</script>
@endpush
@endsection