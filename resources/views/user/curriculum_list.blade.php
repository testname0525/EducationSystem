@extends('user.layouts.app')       <!-- 修正 -->

@section('content')
<div class="container curriculum__container">
    <div class="back_btn"><a href="{{ route('user.show.top') }}">←戻る</a></div>
    <div class="schedule__row">
        <div class="schedule__change">
            <button type="button" class="schedule__back" id="prevMonth">◀</button>
            <p class="schedule__title" id="scheduleTitle">
                <span id="scheduleYear"></span>年<span id="scheduleMonth"></span>月スケジュール</p>
            <button type="button" class="schedule__next" id="nextMonth">▶</button>
        </div>
        <div class="schedule__grade grade__btn--display grade__btn" id="selectedGrade">{{ $initialGrade -> name }}</div>
    </div>

    <div class="curriculum__wrapper">
        <aside class="grades">
            @foreach($grades as $index => $grade)
            <div class="grade__btn">
                <button type="button" class="grades__btn--{{ $index % 12 }} {{$grade -> id == $initialGrade -> id ? 'active' : '' }}" data-grade="{{ $grade -> name }}" data-grade-id="{{ $grade -> id}}">
                    {{ $grade -> name }}
                </button>
            </div>
            @endforeach
        </aside>
        <div class="curriculum__main">
            <div class="cards" id="curriculumCards">
                @foreach($curriculums as $curriculum)
                <a href="{{ route('user.show.delivery') }}" class="card">
                    <div class="img"><img src="{{ $curriculum -> thumbnail }}" alt="{{ $curriculum -> title }}"></div>
                    <h3 class="curriculum__title">{{ $curriculum -> title }}</h3>
                    <div class="delivery">
                        @foreach($curriculum -> deliveryTimes as $time)
                        <p class="delivery__time">
                            {{ $time -> delivery_from -> format('n月j日 H:i') }} - {{ $time -> delivery_to -> format('H:i')}}
                        </p>
                        @endforeach
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
var initialData = {
    year: {{ date('Y') }},
    month: {{ date('m') }},
    gradeId: {{ $initialGrade->id }}
};
</script>
<script src="{{ asset('js/curriculumList.js') }}" data-curriculum-url="{{ route('user.show.curriculum.list') }}"></script>
@endpush
