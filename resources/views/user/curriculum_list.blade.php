@extends('user.layouts.app')       <!-- 修正 -->

@section('content')
<div class="container curriculum__container">
    <div class="back_btn"><a href="{{ route('user.show.top') }}">←戻る</a></div>
    <div class="schedule__row">
        <div class="schedule__change">
            <button type="button" class="schedule__back">◀</button>
            <p class="schedule__title" id="scheduleTitle">
                <span id="scheduleYear">２０２４</span>年<span id="scheduleMonth">８</span>月スケジュール</p>
            <button type="button" class="schedule__next">▶</button>
        </div>
        <div class="schedule__grade grade__btn--display grade__btn" id="selectedGrade">{{ $initialGrade -> name }}</div>
    </div>

    <div class="curriculum__wrapper">
        <aside class="grades">
            @foreach($grades as $index => $grade)
            <div class="grade__btn"><button type="button" class="grades__btn--{{ $index % 12 }}" data-grade="{{ $grade -> name }}">{{ $grade -> name }}</button></div>
            @endforeach
        </aside>
        <div class="curriculum__main">
            <div class="cards">
                <a href="/" class="card">
                    <div class="img"><img src="" alt="">画像</div>
                    <h3 class="curriculum__title">授業タイトル</h3>
                    <div class="delivery">
                        <p class="delivery__time">８月１３日　14:00~15:00</p>
                        <p class="delivery__time">８月１３日　14:00~15:00</p>
                        <p class="delivery__time">８月１３日　14:00~15:00</p>
                        <p class="delivery__time">８月１３日　14:00~15:00</p>
                    </div>
                </a>
                <div class="card">
                    <div class="img"><img src="" alt="">画像</div>
                    <h3 class="curriculum__title">授業タイトル</h3>
                    <div class="delivery">
                        <p class="delivery__time">８月１３日　14:00~15:00</p>
                        <p class="delivery__time">８月１３日　14:00~15:00</p>
                        <p class="delivery__time">８月１３日　14:00~15:00</p>
                        <p class="delivery__time">８月１３日　14:00~15:00</p>
                    </div>
                </div>
                <div class="card">
                    <div class="img"><img src="" alt="">画像</div>
                    <h3 class="curriculum__title">授業タイトル</h3>
                    <div class="delivery">
                        <p class="delivery__time">８月１３日　14:00~15:00</p>
                        <p class="delivery__time">８月１３日　14:00~15:00</p>
                        <p class="delivery__time">８月１３日　14:00~15:00</p>
                        <p class="delivery__time">８月１３日　14:00~15:00</p>
                    </div>
                </div>
                <div class="card">
                    <div class="img"><img src="" alt="">画像</div>
                    <h3 class="curriculum__title">授業タイトル</h3>
                    <div class="delivery">
                        <p class="delivery__time">８月１３日　14:00~15:00</p>
                        <p class="delivery__time">８月１３日　14:00~15:00</p>
                        <p class="delivery__time">８月１３日　14:00~15:00</p>
                        <p class="delivery__time">８月１３日　14:00~15:00</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/curriculumList.js') }}"></script>
@endpush
