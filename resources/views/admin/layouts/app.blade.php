<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-origin shadow-sm">
            <div class="container">
                <!-- <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button> -->

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    @guest('admin')
                            @if (Route::has('admin.login'))
                                <!-- <li class="nav-item">
                                    <a class="nav-link" href="{{ url('admin/login') }}">ログイン</a>
                                </li> --> 
                            @endif

                        @else
                            <li class="nav-item">
                                <a class="nav-link btn_color btn_color-sub" href="{{ route('admin.show.curriculum.list') }}">
                                    授業管理
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn_color btn_color-sub" href="{{ route('admin.show.article.list') }}">
                                    お知らせ管理
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn_color btn_color-sub" href="{{ route('admin.show.banner.edit') }}">
                                    バナー管理
                                </a>
                            </li>
                        @endguest

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest('admin')
                            @if (Route::has('admin.login'))
                                <li class="nav-item">
                                    <a class="nav-link color-origin" href="{{ url('admin/login') }}">ログイン</a>       <!-- 修正 -->
                                </li>
                            @endif

                        @else
                            <li class="nav-item">
                                <a class="nav-link color-origin" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    ログアウト <!-- 修正 -->
                                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none"> <!-- 修正 -->
                                        @csrf
                                    </form>
                                </a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
@stack('scripts')
</html>
