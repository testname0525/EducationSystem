@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Home Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .banner {
            background-color: #f8f9fa; /* バナーの背景色 */
            padding: 10px 0; /* バナーの上下パディング */
            border-bottom: 1px solid #dee2e6; /* バナーの下部にボーダーを追加 */
        }
    </style>
</head>
<body>
    <!-- バナー部分 -->    
    <!-- コンテンツ部分 -->
    <div class="container min-vh-100 d-flex justify-content-center align-items-center">
        <div class="text-center">
            <h1>Welcome to the Home Page</h1>
            <div class="border border-light rounded p-4 shadow-sm mx-auto" style="max-width: 400px;">
                <h2>Login as:</h2>
                <a href="{{ route('admin.login') }}" class="btn btn-primary d-block my-2">Admin Login</a>
                <a href="{{ route('user.login') }}" class="btn btn-danger d-block my-2">User Login</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
@endsection
