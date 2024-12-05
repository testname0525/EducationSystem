@extends('user.layouts.app')

@section('content')
<!-- 戻るボタン -->
<a href="{{ route('user.show.article.list') }}" class="btn btn-link" style="background: transparent; color: black; border: none;">
        ← 戻る
</a>
<div class="container">
    <h2>プロフィール変更</h2>

    <!-- プロフィール編集フォーム -->
    <form action="{{ route('user.update.profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="row">
            <!-- プロフィール画像とテキスト -->
            <div class="d-flex align-items-center ml-3 mt-3">
                <div class="me-3">
                    @if(Auth::check() && Auth::user()-> profile_image)
                        <img src="{{ asset('storage/images/profile/' . Auth::user()->profile_image) }}" alt="プロフィール画像" class="img-thumbnail" style="width: 100px; height: 140px;">
                    @else
                        <img src="{{ asset('storage/images/profile/no-image.jpg') }}" alt="No Image" style="width: 100px; height: 140px;">
                    @endif
                </div>
            </div>
            <!-- プロフィール画像変更ボタン -->
            <div class="mt-3" style="margin-left: 0;">
                    <div class="mb-3 ml-5">
                        <h3 for="profile_image" class="form-label mb-3 mt-3">プロフィール画像</h3>
                        <input type="file" class="form-control" id="profile_image" name="profile_image">
                    </div>
            </div>
        </div>

        <!-- ユーザーネーム -->
            <div class="row mb-3 d-flex mt-5">
                <label for="name" class="form-label col-md-3 text-right">ユーザーネーム</label>
                <input type="text" class="form-control col-md-6 text-left" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <!-- カナ -->
            <div class="row mb-3 d-flex">
                <label for="name_kana" class="form-label col-md-3 text-right">カナ</label>
                <input type="text" class="form-control col-md-6 text-left" id="name_kana" name="name_kana" value="{{ old('name_kana', $user->name_kana) }}" required>
            </div>

            <!-- メールアドレス -->
            <div class="row mb-3 d-flex">
                <label for="email" class="form-label col-md-3 text-right">メールアドレス</label>
                <input type="email" class="form-control col-md-6 text-left" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <!-- パスワード -->
            <div class="row mb-3 d-flex">
                <label for="password" class="form-label col-md-3 text-right">パスワード</label>
                <div class="col-md-5 text-start">
                    <a href="{{ route('user.show.password.edit') }}" class="btn btn-link col-md-6 border text-center">パスワードを変更する</a>
                </div>
            </div>
            <!-- 登録ボタン -->
            <div class="text-center">
                <button type="submit" class="btn btn-danger w-25 mb-3">登録</button>
            </div>
    </form>
    <!-- フラッシュメッセージ -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
</div>
        <!-- エラーメッセージや成功メッセージを表示するためのエリア -->
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


        

@endsection
