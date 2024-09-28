@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $curriculum->title }}</h1>
    <p>{{ $curriculum->description }}</p>

    @if($curriculum->video_url)
        <div class="video-container">
            <video src="{{ $curriculum->video_url }}" controls></video>
        </div>
    @endif

    <div class="curriculum-content">
        {!! $curriculum->content !!}
    </div>

    <button id="completeButton" class="btn btn-primary">受講完了</button>
</div>

<script>
document.getElementById('completeButton').addEventListener('click', function() {
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
        }
    })
    .catch((error) => {
        console.error('Error:', error);
    });
});
</script>
@endsection