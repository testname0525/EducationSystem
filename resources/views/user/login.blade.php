@extends('layouts.app')

@section('content')
<div class="container">
    <h2>ログイン</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('user.login') }}">
        @csrf
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>
        <div class="form-group">
            <label for="password">パスワード</label>
            <input id="password" type="password" name="password" required>
        </div>
        <div class="form-group">
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember">ログイン状態を保持する</label>
        </div>
        <button type="submit" class="btn-submit">ログイン</button>
    </form>
    <p>新規会員登録は<a href="{{ route('user.register') }}">こちら</a></p>
</div>
@endsection