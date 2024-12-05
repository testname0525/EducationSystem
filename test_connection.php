<?php
require_once 'config.php'; // または適切な設定ファイル

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("接続失敗: " . $conn->connect_error);
}
echo "データベースに正常に接続しました";
$conn->close();
?>