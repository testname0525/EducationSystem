@extends('admin.layouts.app')       <!-- 修正 -->

@section('content')
<div class="container">
    <div class="back_btn"><a href="/">←戻る</a></div>
    <div class="banner_title">バナー管理</div>
    <div class="banner_rows">
        <div class="banner_row">
            <div class="banner_row-img"><img src="" alt="">画像</div>
            <form action="route('show.banner.edit')" method="POST" enctype='multipart/form-data'>
                <input type="file" name="image">
            </form>
            <div class="banner_row-destroy"><img src="{{ asset('storage/image/remove_btn.jpeg') }}" alt="削除アイコン"></div>
        </div>
        <div class="banner_row">
            <div class="banner_row-img"><img src="" alt="">画像</div>
            <form action="route('show.banner.edit')" method="POST" enctype='multipart/form-data'>
                <input type="file" name="image">
            </form>
            <div class="banner_row-destroy"><img src="{{ asset('storage/image/remove_btn.jpeg') }}" alt="削除アイコン"></div>
        </div>
        <div class="banner_row">
            <div class="banner_row-img"><img src="" alt="">画像</div>
            <form action="route('show.banner.edit')" method="POST" enctype='multipart/form-data'>
                <input type="file" name="image">
            </form>
            <div class="banner_row-destroy"><img src="{{ asset('storage/image/remove_btn.jpeg') }}" alt="削除アイコン"></div>
        </div>
    </div><!-- banner_rows -->
    <div class="banner_create"><img src="{{ asset('storage/image/add_btn.jpeg') }}" alt="追加アイコン"></div>
    <div class="btn_origin">
        <button type="submit" class="btn btn_color">
            登録
        </button>
    </div>
</div>
@endsection
