<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

// オートローダーの読み込み
require __DIR__.'/../vendor/autoload.php';

// アプリケーションのインスタンスを作成
$app = require_once __DIR__.'/../bootstrap/app.php';

// HTTP カーネルのインスタンスを取得
$kernel = $app->make(Kernel::class);

// HTTP リクエストを作成
$request = Request::capture();

// リクエストを Kernel で処理し、レスポンスを送信
$response = $kernel->handle($request);
$response->send();

// リクエストの処理を終了
$kernel->terminate($request, $response);
