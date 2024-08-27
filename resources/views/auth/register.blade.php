@extends('layouts.app')

@section('content')
<div class="container">
    <h2>ユーザー登録</h2>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">名前</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
        </div>
        <div>
            <label for="name_kana">名前（カナ）</label>
            <input id="name_kana" type="text" name="name_kana" value="{{ old('name_kana') }}" required>
        </div>
        <div>
            <label for="email">メールアドレス</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div>
            <label for="password">パスワード</label>
            <input id="password" type="password" name="password" required>
        </div>
        <div>
            <label for="password-confirm">パスワード（確認）</label>
            <input id="password-confirm" type="password" name="password_confirmation" required>
        </div>
        <div>
            <label for="grade_id">学年</label>
            <select id="grade_id" name="grade_id" required>
                @foreach($grades as $grade)
                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="profile_image">プロフィール画像</label>
            <input id="profile_image" type="file" name="profile_image">
        </div>
        <div>
            <button type="submit">登録</button>
        </div>
    </form>
</div>
@endsection