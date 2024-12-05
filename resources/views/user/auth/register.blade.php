@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!-- 戻るボタン -->
    <a href="{{ route('user.login') }}" class="btn btn-link" style="background: transparent; color: black; border: none;">
        ← 戻る
    </a>
    <div class="container min-vh-100 d-flex justify-content-center align-items-center">
        <div class="container" style="max-width: 400px;">
            <div class="card">
                <div class="card-header text-center">
                    <h4>User Registration</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.register.submit') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" class="form-control" name="name" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="name_kana">Kana</label>
                            <input type="text" id="name_kana" class="form-control" name="name_kana" required>
                        </div>
                        <div class="form-group">
                            <label for="grade_id">Grade</label>
                                <select id="grade_id" class="form-control" name="grade_id" required>
                                    @foreach($grades as $grade)
                                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</body>


@endsection
