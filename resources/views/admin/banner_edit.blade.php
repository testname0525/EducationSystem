@extends('admin.layouts.app')       <!-- 修正 -->

@section('content')
<div class="container">
    <div class="back_btn"><a href="{{ route('admin.show.top') }}">←戻る</a></div>
    <div class="banner_title">バナー管理</div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form action="{{ route('admin.show.banner.store') }}" method="POST" enctype='multipart/form-data' id="banner_form">
                @csrf
        <div class="banner_rows">
            @foreach($banners as $banner)
            <div class="banner_row">
                <div class="banner_row-img"><img src="{{ asset($banner -> image) }}" alt="バナー画像"></div>
                <input type="file" name="images[{{ $banner -> id}}]" class="banner_image-input" >
                <button type="button" class="banner_row-destroy" data-id="{{ $banner -> id }}"><img src="{{ asset('storage/image/remove_btn.jpeg') }}" alt="削除アイコン"></button>
            </div>
            @endforeach
        </div><!-- banner_rows -->
        <button type="button" class="banner_create" id="banner_create"><img src="{{ asset('storage/image/add_btn.jpeg') }}" alt="追加アイコン"></button>
        <div class="btn_origin">
            <button type="submit" class="btn btn_color">
                登録
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    var placeholderImageUrl = "{{ asset('storage/images/placeholder.png') }}";
    var removeButtonImageUrl = "{{ asset('storage/image/remove_btn.jpeg') }}";
</script>
<script src="{{ asset('js/banner.js') }}"></script>
@endpush
