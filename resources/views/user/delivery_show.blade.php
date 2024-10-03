@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $curriculum->grade->name }}</h2>
    <h3>{{ $curriculum->title }}</h3>
    <p>{{ $curriculum->description }}</p>

    @php
        $now = \Carbon\Carbon::now();
        $isWithinDeliveryPeriod = $now->between($curriculum->delivery_start, $curriculum->delivery_end);
    @endphp

    @if($isWithinDeliveryPeriod)
        <div class="video-container">
            <video src="{{ $curriculum->video_url }}" controls></video>
        </div>
        <button id="completeButton" class="btn btn-primary">受講完了</button>
    @else
        <p>この授業は現在配信期間外です。</p>
    @endif
</div>

@if($isWithinDeliveryPeriod)
<script>
document.getElementById('completeButton').addEventListener('click', function() {
    fetch('{{ route("user.delivery.progress", $curriculum->id) }}', {
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
@endif
@endsection