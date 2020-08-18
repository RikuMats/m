<?php
//データベースを作る
//その他　初期化があれば行う

require 'config_sql.php';

$pdo = new PDO(DSN,USER,PASS,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
echo "connected<br>";

//ユーザ名パスワードメールアドレスなどの基本的な情報を格納するテーブル
$sql = "CREATE TABLE IF NOT EXISTS essential_user_data"
    ."("
    ."id INT AUTO_INCREMENT PRIMARY KEY,"
    ."name char(32),"
    ."password char(6),"
    ."email TEXT"
    .")";

$stmt = $pdo->query($sql);

//登録された本をまとめておくマスタ
$sql = "CREATE TABLE IF NOT EXISTS bookmaster"
    ."("
    ."id INT AUTO_INCREMENT PRIMARY KEY,"
    ."title char(32),"
    ."author char(32),"
    ."publisher char(32)"
    .")";

$stmt = $pdo->query($sql);

//ユーザと本と未読、読了などの情報を保持する
$sql = "CREATE TABLE IF NOT EXISTS user_book_table"
    ."("
    ."book_id INT,"
    ."user_id INT,"
    ."status char(10)"//unread,red
    .")";
echo "end";
$stmt = $pdo->query($sql);
?>
