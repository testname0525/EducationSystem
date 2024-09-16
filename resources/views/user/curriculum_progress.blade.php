@extends('user.layouts.app')

@section('content')
<!-- 戻るボタン -->
<a href="{{ route('user.show.article.list') }}" class="btn btn-link" style="background: transparent; color: black; border: none;">
        ← 戻る
    </a>

        <div class="container mt-3">
            <div class="row">
                <!-- プロフィール画像表示 -->
                <div class="col-md-2 d-flex align-items-center ml-3">
                    @if(Auth::check() && Auth::user()-> profile_image)
                    <img src="{{ asset('storage/images/profile/' . Auth::user()->profile_image) }}" alt="プロフィール画像" class="img-thumbnail" style="width: 100px; height: 140px;">
                    @else
                        <img src="{{ asset('storage/images/profile/no-image.jpg') }}" alt="No Image" style="width:100px; height:140px;">
                    @endif
                </div>

                <div class="mt-3" style="margin-left: 0;">
                    <!-- 名前表示 -->
                    <h3 class="mb-4">{{ $user -> name }} さんの授業進捗</h3>
                    <!-- 学年表示 -->
                    <h3 class="mb-4">現在の学年：{{ $user -> grade -> name }}</h3>
                </div>
            </div>

            <div class="container mt-5">
                <!-- 学年ごとの授業一覧 -->
                <div class="row">
                    @foreach($grades as $grade)
                    <div class="col-sm-4">
                            <button class="btn btn-secondary rounded-pill" type="button" disabled>{{ $grade -> name }}</button>
                         <!-- カリキュラムリスト -->
                        <div class="p-3">
                        <ul class="list-unstyled">
                            @foreach($grade -> curriculums as $curriculum)
                                @php
                                    $userGradeId = $user->grade->id;
                                    $isDisabled = $grade->id > $userGradeId;
                                    $userProgress = $curriculum->progresses->where('user_id', Auth::id())->first();
                                    $isCompleted = $curriculum->progresses->where('user_id', Auth::id())->first()?->clear_flg;
                                @endphp
                                    <li class="mb-2">
                                        @if ($isDisabled)
                                            <span class="text-muted">
                                                @if($isCompleted == 1)
                                                    <span class="text-danger fs-2">受講済</span>
                                                @else
                                                    <span class="text-danger ml-5"></span>
                                                @endif
                                                {{ $curriculum -> title }}
                                            </span>
                                        @else
                                            <a href="{{ $isCompleted ? '#' : '/curriculum/' . $curriculum->id }}" class="{{ $isCompleted ? 'text-decoration-none' : '' }}">
                                                @if ($isCompleted)
                                                    <span class="text-danger">受講済</span>
                                                @else
                                                    <span class="mr-5"></span>
                                                @endif
                                                {{ $curriculum->title }}
                                            </a>
                                        @endif
                                    </li>                
                            @endforeach
                        </ul>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>

@endsection
