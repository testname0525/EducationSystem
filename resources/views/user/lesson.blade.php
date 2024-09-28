@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <a href="{{ route('user.timetable') }}" class="btn btn-secondary mr-2">時間割</a>
                            <a href="{{ route('user.progress') }}" class="btn btn-secondary mr-2">授業進捗</a>
                            <a href="{{ route('user.profile') }}" class="btn btn-secondary">プロフィール設定</a>
                        </div>
                        <a href="{{ route('logout') }}" class="btn btn-light"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('ログアウト') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <a href="{{ route('user.timetable') }}" class="btn btn-secondary mb-3">← 戻る</a>

                    <div class="embed-responsive embed-responsive-16by9 mb-3">
                        <iframe class="embed-responsive-item" src="{{ $lesson->video_url }}" allowfullscreen></iframe>
                    </div>

                    <div class="text-right mb-3">
                        <button class="btn btn-success" id="completeLesson">受講しました</button>
                    </div>

                    <h5 class="card-title">{{ $lesson->grade->name }}</h5>
                    <h2 class="card-title">{{ $lesson->title }}</h2>
                    
                    <div class="card-text">
                        <h4>講座内容</h4>
                        <p>{{ $lesson->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#completeLesson').click(function() {
            $.ajax({
                url: '{{ route("user.lesson.complete", $lesson->id) }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        alert('授業を完了しました！');
                        $('#completeLesson').prop('disabled', true);
                    }
                },
                error: function() {
                    alert('エラーが発生しました。もう一度お試しください。');
                }
            });
        });
    });
</script>
@endsection