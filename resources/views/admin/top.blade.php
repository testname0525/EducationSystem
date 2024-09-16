<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Top Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@extends('admin.layouts.app')

@section('content')

    <!-- コンテンツ部分 -->
    <div class="container my-4 mt-5 d-flex justify-content-center">
        <!-- 管理者情報表示 -->
        <div class="p-4 bg-light border rounded mt-5 w-50">
            <div class="ml-5">
                <p><strong>ユーザーネーム:</strong> {{ $admin->name }}</p>
                <p><strong>メールアドレス:</strong> {{ $admin->email }}</p>
            </div>
        </div>
    </div>

</body>
</html>
@endsection