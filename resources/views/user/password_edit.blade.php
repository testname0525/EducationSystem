@extends('user.layouts.app')

@section('content')
<!-- 戻るボタン -->
<a href="{{ route('user.show.profile') }}" class="btn btn-link" style="background: transparent; color: black; border: none;">
        ← 戻る
</a>
<div class="container">
    <h2>パスワード変更</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user.update.password') }}" method="POST">
        @csrf
            <div class="row mb-3 d-flex mt-5">
                <label for="current_password" class="form-label col-md-3 text-right">旧パスワード</label>
                <input type="password" class="form-control col-md-6 text-left" id="current_password" name="current_password" required>
            </div>

            <div class="row mb-3 d-flex mt-5">
                <label for="new_password" class="form-label col-md-3 text-right">新パスワード</label>
                <input type="password" class="form-control col-md-6 text-left" id="new_password" name="new_password" required>
            </div>

            <div class="row mb-3 d-flex mt-5">
                <label for="new_password_confirmation" class="form-label col-md-3 text-right">新パスワード確認</label>
                <input type="password" class="form-control col-md-6 text-left" id="new_password_confirmation" name="new_password_confirmation" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-danger w-25 mb-3 mt-5">登録</button>
            </div>
    </form>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
</div>
@endsection
