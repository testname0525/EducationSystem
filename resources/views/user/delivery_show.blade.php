@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $curriculum->title }}</h2>
    <div class="video-container">
        <video id="curriculum-video" src="{{ $curriculum->video_url }}" controls></video>
    </div>
    <button id="complete-btn" class="btn">完了</button>
</div>

<script>
document.getElementById('complete-btn').addEventListener('click', function() {
    fetch('{{ route("user.delivery.progress", $curriculum->id) }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({})
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('進捗が更新されました。');
        }
    });
});
</script>
@endsection