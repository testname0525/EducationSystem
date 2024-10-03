@extends('layouts.app')

@section('content')
<div class="container">
    <h1>新規会員登録</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('user.register') }}">
        @csrf
        <div class="form-group">
            <label for="name">ユーザーネーム</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label for="name_kana">カナ</label>
            <input type="text" class="form-control" id="name_kana" name="name_kana" value="{{ old('name_kana') }}" required>
        </div>
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">パスワード確認</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>
        <button type="submit" class="btn btn-primary">登録</button>
    </form>
    
    <p class="mt-3">ログインは<a href="{{ route('user.login') }}">こちら</a></p>
</div>
@endsection