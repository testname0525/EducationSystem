<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Top Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <!-- ヘッダー部分 -->
    <header class="bg-info py-3">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <!-- ボタン群 -->
                <div class="d-flex">                
                    <a href="#" class="btn btn-secondary mx-2">授業管理</a>
                    <a href="{{ route('admin.show.article.list') }}" class="btn btn-secondary mx-2">お知らせ管理</a>
                    <a href="#" class="btn btn-secondary mx-2">バナー管理</a>
                </div>
                <!-- ログアウトボタン -->
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-light">ログアウト</button>
                </form>
            </div>
        </div>
    </header>
    <!-- コンテンツ部分 -->
    <main class="container mt-4">
        @yield('content')
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
