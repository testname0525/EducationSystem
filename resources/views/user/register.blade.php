@extends('layouts.app')

@section('content')
    <h1>新規会員登録</h1>
    <form method="POST" action="{{ route('user.register') }}">
        @csrf
        <div class="form-group">
            <label for="name">ユーザーネーム</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="name_kana">カナ</label>
            <input type="text" id="name_kana" name="name_kana" required>
        </div>
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">パスワード確認</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>
        <button type="submit" class="btn-submit">登録</button>
    </form>
    <p>ログインは<a href="{{ route('user.login') }}">こちら</a></p>
@endsection