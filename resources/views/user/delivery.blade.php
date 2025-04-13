@extends('layouts.app')

@section('content')
<div class="container">
    <h2>配信コンテンツ</h2>
    
    <div class="row">
        @foreach($curriculums as $curriculum)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        {{ $curriculum->title }}
                    </div>
                    <div class="card-body">
                        <!-- 画像表示領域 -->
                        <div class="image-container">
                            @if($curriculum->isAvailable())
                                <!-- 常時公開か配信期間内の場合 -->
                                <img src="{{ asset('images/image'.$curriculum->id.'.jpg') }}" class="img-fluid" alt="{{ $curriculum->title }}">
                                
                                <!-- 受講しましたボタン - 有効 -->
                                @php
                                    $progress = $curriculum->progresses()->where('user_id', Auth::id())->first();
                                @endphp
                                
                                @if($progress && $progress->clear_flg)
                                    <button class="btn btn-secondary mt-2" disabled>受講しました</button>
                                @else
                                    <button class="btn btn-success mt-2 completion-button" 
                                            data-curriculum-id="{{ $curriculum->id }}">
                                        受講しました
                                    </button>
                                @endif
                            @else
                                <!-- 公開されていない場合は代替画像 -->
                                <img src="{{ asset('images/not-available.jpg') }}" class="img-fluid" alt="配信期間外">
                                <!-- 受講しましたボタン - 無効 -->
                                <button class="btn btn-secondary mt-2" disabled>受講しました</button>
                            @endif
                        </div>
                        <p class="mt-2">{{ $curriculum->description }}</p>
                        
                        <!-- 戻るリンク (テスト項目16用) -->
                        <a href="#" class="btn btn-outline-primary mt-3 back-link">戻る</a>
                    </div>
                    <div class="card-footer text-muted">
                        @if($curriculum->always_delivery_flg)
                            常時公開
                        @else
                            @foreach($curriculum->deliveryTimes as $deliveryTime)
                                配信期間: {{ date('Y/m/d', strtotime($deliveryTime->delivery_from)) }} 
                                〜 {{ date('Y/m/d', strtotime($deliveryTime->delivery_to)) }}
                                @if(!$loop->last)<br>@endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <!-- 画像表示ボタン（テスト項目13用） -->
    <div class="mt-4">
        <button id="show-image-button" class="btn btn-primary">画像表示</button>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // 「受講しました」ボタンのクリックイベント (テスト項目14、15用)
        $('.completion-button').click(function() {
            var curriculumId = $(this).data('curriculum-id');
            
            // Ajaxリクエスト
            $.ajax({
                url: '/delivery/' + curriculumId + '/progress',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('受講完了が記録されました');
                    // ボタンを無効化
                    $('.completion-button[data-curriculum-id="' + curriculumId + '"]')
                        .prop('disabled', true)
                        .removeClass('btn-success')
                        .addClass('btn-secondary')
                        .text('受講しました');
                },
                error: function(error) {
                    console.error('エラーが発生しました:', error);
                    alert('処理中にエラーが発生しました');
                }
            });
        });
        
        // 戻るリンクのクリックイベント (テスト項目16用)
        $('.back-link').click(function(e) {
            e.preventDefault();
            window.history.back();
        });
        
        // 画像表示ボタンのクリックイベント (テスト項目13用)
        $('#show-image-button').click(function() {
            var imageUrl = '/show-image/1'; // 1番目の画像を表示
            window.location.href = imageUrl;
        });
    });
</script>
@endsection