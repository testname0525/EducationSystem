@foreach($curriculums as $curriculum)
<a href="{{ route('user.show.delivery') }}" class="card-curriculum">
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
