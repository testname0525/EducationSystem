<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ラーニングマネジメントシステム</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #e67e22;
            color: white;
            padding: 10px 0;
        }
        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .nav-links {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }
        .nav-links li {
            margin-left: 20px;
        }
        .nav-links a, .btn {
            text-decoration: none;
            color: white;
            background-color: #16a085;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .btn-submit {
            background-color: #e67e22;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .banner-container {
            margin-bottom: 20px;
        }
        .banner-nav {
            text-align: center;
            margin-top: 10px;
        }
        .banner-dot {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #ccc;
            margin: 0 5px;
        }
        .articles {
            margin-top: 20px;
        }
        .articles ul {
            list-style: none;
            padding: 0;
        }
        .articles li {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <nav class="nav">
                <a href="{{ route('user.top') }}" class="logo">LMS</a>
                <ul class="nav-links">
                    @guest
                        <li><a href="{{ route('user.login') }}">ログイン</a></li>
                        <li><a href="{{ route('user.register') }}">新規登録</a></li>
                    @else
                        <li><a href="{{ route('user.timetable') }}">時間割</a></li>
                        <li><a href="{{ route('user.progress') }}">授業進捗</a></li>
                        <li><a href="{{ route('user.profile') }}">プロフィール設定</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn">ログアウト</button>
                            </form>
                        </li>
                    @endguest
                </ul>
            </nav>
        </div>
    </header>

    <main class="container">
        @yield('content')
    </main>
</body>
</html>